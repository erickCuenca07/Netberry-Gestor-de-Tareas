<?php

namespace Task\Domain\Service;

use Task\Domain\Model\InsertTask;

class ServiceInsertTask
{
    public function __construct(private InsertTask $insertTask){}

    public function execute(string $task)
    {
        return $this->insertTask->insertTask($task);
    }
}