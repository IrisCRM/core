<?php

namespace Iris\Queue;

use Bernard\Message\DefaultMessage;
use Bernard\Producer;
use Iris\Iris;

trait DispatchesJobs
{
    /**
     * Отправляет задание в очередь
     * @param string $queueName
     * @param mixed $message
     */
    protected function dispatch(string $queueName, $message = [])
    {
        $container = Iris::$app->getContainer();
        /** @var Producer $producer */
        $producer = $container->get('queue.producer');
        $producer->produce(new DefaultMessage($queueName, $message), $queueName);
    }
}