<?php

namespace Iris\Queue;

use Bernard\Consumer;
use Bernard\Message;
use Bernard\Producer;
use Bernard\QueueFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ConsumingProducer extends Producer
{
    /**
     * @var Consumer
     */
    protected $consumer;

    /**
     * ConsumingProducer constructor.
     * @param QueueFactory $queues
     * @param EventDispatcherInterface $dispatcher
     * @param Consumer $consumer
     */
    public function __construct(QueueFactory $queues, EventDispatcherInterface $dispatcher, Consumer $consumer)
    {
        parent::__construct($queues, $dispatcher);
        $this->consumer = $consumer;
    }

    /**
     * @inheritdoc
     */
    public function produce(Message $message, $queueName = null)
    {
        parent::produce($message, $queueName);
        $this->consumer->tick($this->queues->create($queueName), [
            'stop-on-error' => true,
        ]);
    }
}