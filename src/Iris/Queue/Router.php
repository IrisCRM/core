<?php

namespace Iris\Queue;

use Bernard\Envelope;
use Bernard\Exception\ReceiverNotFoundException;
use Bernard\Router as RouterInterface;
use Loader;

/**
 * Маршрутизатор сообщений для очередей, который по названию очереди определяет подходящий класс для обработки задания
 * @package Iris\Queue
 */
class Router implements RouterInterface
{
    /**
     * @var Loader
     */
    protected $loader;

    /**
     * Router constructor.
     * @param Loader $loader
     */
    public function __construct($loader)
    {
        $this->loader = $loader;
    }

    /**
     * @inheritdoc
     */
    public function map(Envelope $envelope)
    {
        $receiver = $this->get($envelope->getName());

        if (false == $receiver) {
            throw new ReceiverNotFoundException(sprintf('No receiver found with name "%s".', $envelope->getName()));
        }

        if (is_callable($receiver)) {
            return $receiver;
        }

        return [$receiver, 'handle'];
    }

    /**
     * Get job class
     * @param string $queueName
     * @return mixed
     */
    protected function get(string $queueName)
    {
        $relativeClassName = 'Job\\' . $this->transformName($queueName) . 'Job';
        $class = $this->loader->getActualClassName($relativeClassName, true);
        if (!$class) {
            throw new \RuntimeException(sprintf('Job for queue "%s" was not found', $queueName));
        }
        return new $class;
    }

    /**
     * Преобразовать название очереди в относительное имя класса
     * @param string $name Название очереди
     * @return string Относительная название класса
     */
    protected function transformName(string $name)
    {
        $parts = explode('-', $name);
        foreach ($parts as $key => $part) {
            $parts[$key] = ucfirst($part);
        }
        $name = implode('', $parts);

        $parts = explode(':', $name);
        foreach ($parts as $key => $part) {
            $parts[$key] = ucfirst($part);
        }
        $name = implode('\\', $parts);

        return $name;
    }
}