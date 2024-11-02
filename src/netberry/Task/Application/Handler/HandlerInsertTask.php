<?php

namespace Task\Application\Handler;

use Task\Domain\Service\ServiceInsertTask;

class HandlerInsertTask
{
    public function __construct(private ServiceInsertTask $serviceInsertTask){}

    public function handle(string $task)
    {
        return $this->serviceInsertTask->execute($task);
    }    
}