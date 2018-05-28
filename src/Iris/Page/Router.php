<?php

namespace Iris\Page;

use Iris\Annotation\RequestMethod;
use Iris\Annotation\RequireAuth;

class Router
{
    /**
     * @var \Loader
     */
    protected $loader;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var \Language
     */
    protected $translate;

    public function __construct($request, $loader)
    {
        $this->request = $request;
        $this->loader = $loader;
        $this->translate = \Language::getInstance();
    }

    public function route()
    {
        $urlParts = explode('/', trim($this->request->getPathInfo(), '/'));
        $section = $urlParts[1];
        $method = $urlParts[2];
        $class = 'page_' . $section;

        $actualClassName = $this->loader->getActualClassName('sections\\' . $section . '\\' . $class);

        // Check auth
        $requireAuth = $this->loader->getClassMethodAnnotation($actualClassName, $method, RequireAuth::class);
        if ($requireAuth->isRequire() && !isAuthorised()) {
            $data = [
                'errorMessage' => $this->translate->t('Не авторизован'),
            ];
            getView('error', $data);
            return;
        }

        // Check method allowed
        $requestMethod = $this->loader->getClassMethodAnnotation($actualClassName, $method, RequestMethod::class);
        $requestedMethod = strtoupper($this->request->getMethod());
        $allowedMethods = $requestMethod->getAllowedMethods();
        if (!empty($requestMethod->value) && !in_array($requestedMethod, $allowedMethods)) {
            $data = [
                'errorMessage' => $this->translate->t('Доступ запрещен'),
            ];
            getView('error', $data);
            return;
        }

        if (
            class_exists($actualClassName) &&
            method_exists($actualClassName, $method)
        ) {
            $object = new $actualClassName($this->loader);
            $html = $object->$method($this->request);
            echo $html;
            return;
        }
        else {
            $data = [
                'errorMessage' => $this->translate->t('Ошибка доступа к методу'),
            ];
            getView('error', $data);
            return;
        }
    }
}
