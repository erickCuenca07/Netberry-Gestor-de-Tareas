<?php

namespace Task\Infrastructure\Persistence;

use Task\Domain\Model\InsertTask;
use Illuminate\Support\Facades\DB;

class InsertTaskDB implements InsertTask
{
    private $conection = 'mysql';
    private $table = 'tasks';
    public function insertTask(string $task)
    {
            return DB::connection($this->conection)
                ->table($this->table)
                ->insertGetId(['name' => $task]);
    }
}