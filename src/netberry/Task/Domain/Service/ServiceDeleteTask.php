<?php

namespace Task\Domain\Service;

use Task\Domain\Model\DeleteTask;

class ServiceDeleteTask
{
    public function __construct(private DeleteTask $deleteTask){}

    public function execute($id)
    {
        return $this->deleteTask->delete($id);
    }
}