<?php

namespace Task\Domain\Service;

use Task\Domain\Model\GetTask;

class ServiceGetTask
{
    public function __construct(private GetTask $getTask) {}

    public function execute(): array
    {
        return $this->getTask->getTask();
    }
}