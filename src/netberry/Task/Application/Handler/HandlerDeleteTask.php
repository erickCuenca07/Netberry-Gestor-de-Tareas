<?php

namespace Task\Application\Handler;

use Task\Domain\Service\ServiceDeleteTask;

class HandlerDeleteTask
{
    public function __construct(private ServiceDeleteTask $serviceDeleteTask){}

    public function handle($id)
    {
        return $this->serviceDeleteTask->execute($id);
    }
}