<?php

namespace Task\Domain\Model;

interface InsertTask
{
    public function insertTask(string $task);
}