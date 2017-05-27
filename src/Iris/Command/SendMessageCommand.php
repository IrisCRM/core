<?php

namespace Iris\Command;

use Iris\Queue\DispatchesJobs;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @fixme Эта команда добавлена сюда для иллюстрации работы с очередью. Ее надо удалить перед релизом.
 * @deprecated
 * Class SendMessageCommand
 * @package Iris\Command
 */
class SendMessageCommand extends Command
{
    use DispatchesJobs;

    protected function configure()
    {
        $this
            ->setName('iris:msg')
            ->setDescription('Send test command to worker')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $num = 1;
        while (true) {
            $this->dispatch('some-section:test-queue-name', [
                'number' => $num,
            ]);
            $num++;

            sleep(1);
        }
    }

}