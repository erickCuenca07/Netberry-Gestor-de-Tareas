<?php

namespace Task\Application\Handler;

use Task\Domain\Service\ServiceGetTask;

class HandlerGetTask
{
    public function __construct(private ServiceGetTask $serviceGetTask){}

    public function handle(): array
    {
        return $this->serviceGetTask->execute();
    }
}