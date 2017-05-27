<?php

namespace Iris\Queue;

//use Bernard\EventListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventDispatcherFactory
{
    static protected $dispatcher = null;

    static public function create()
    {
        if (!self::$dispatcher)
        {
            self::$dispatcher = new EventDispatcher;
//            self::$dispatcher->addSubscriber(new EventListener\ErrorLogSubscriber);
//            self::$dispatcher->addSubscriber(new EventListener\FailureSubscriber($this->getQueueFactory()));
        }

        return self::$dispatcher;
    }
}