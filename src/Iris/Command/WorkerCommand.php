<?php

namespace Iris\Command;

use Bernard\Consumer;
use Iris\Iris;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class WorkerCommand
 * @package Iris\Command
 * @usage ./iris iris:worker some-section:test-queue-name
 */
class WorkerCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('iris:worker')
            ->setDescription('Run worker for specified queue')
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = Iris::$app->getContainer();
        $queueName = $input->getArgument('queue');

        /** @var \Bernard\QueueFactory $queues */
        $queues = $container->get('queue.factory');
        /** @var \Bernard\Queue $queue */
        $queue = $queues->create($queueName);
        /** @var Consumer $consumer */
        $consumer = $container->get('queue.consumer');

        $consumer->consume($queue, [
            'stop-on-error' => true,
        ]);
    }


}