<?php

namespace Iris\Api;

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
        $transport = new \Transport();

        $urlParts = explode('/', trim($this->request->getPathInfo(), '/'));
        $section = $urlParts[1];
        $method = $urlParts[2];
        $class = 'api_' . $section;

        $actualClassName = $this->loader->getActualClassName('sections\\' . $section . '\\' . $class);

        // Check auth
        $requireAuth = $this->loader->getClassMethodAnnotation($actualClassName, $method, RequireAuth::class);
        if ($requireAuth->isRequire() && !isAuthorised()) {
            $transport->error($this->translate->t('Не авторизован'), 'no_auth');
            echo json_encode($transport->get());
            return;
        }

        // Check method allowed
        $requestMethod = $this->loader->getClassMethodAnnotation($actualClassName, $method, RequestMethod::class);
        $requestedMethod = strtoupper($this->request->getMethod());
        $allowedMethods = $requestMethod->getAllowedMethods();
        if (!empty($requestMethod->value) && !in_array($requestedMethod, $allowedMethods)) {
            $transport->error($this->translate->t('Доступ запрещен'), 'access_denied');
            echo json_encode($transport->get());
            return;
        }

        if (
            class_exists($actualClassName) &&
            method_exists($actualClassName, $method)
        ) {
            $object = new $actualClassName($this->loader);
            $transport->setData($object->$method($this->request));
        }
        else {
            $transport->error($this->translate->t('Ошибка доступа к методу API'), 'file_not_found');
        }

        echo json_encode($transport->get());
    }
}
