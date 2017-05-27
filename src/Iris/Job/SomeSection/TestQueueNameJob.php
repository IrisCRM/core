<?php

namespace Iris\Job\SomeSection;

use Bernard\Message\AbstractMessage;
use Iris\Job\AbstractJob;

/**
 * @fixme Эта задача добавлена сюда для иллюстрации работы с очередью. Ее надо удалить перед релизом.
 * @deprecated
 * Class TestQueueNameJob
 * @package Iris\Job\SomeSection
 */
class TestQueueNameJob extends AbstractJob
{

    /**
     * @inheritdoc
     */
    public function handle(AbstractMessage $message)
    {
        echo 'Job ' . $message->number . ' started ... ';
        usleep(200);
        echo 'job finished' . PHP_EOL;
    }
}