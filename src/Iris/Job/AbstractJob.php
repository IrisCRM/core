<?php

namespace Iris\Job;

use Bernard\Message\AbstractMessage;

abstract class AbstractJob
{
    /**
     * Process task from queue
     * @param AbstractMessage $message
     */
    abstract public function handle(AbstractMessage $message);
}