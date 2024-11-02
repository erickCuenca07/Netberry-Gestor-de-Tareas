<?php

namespace Task\Infrastructure\Persistence;

use Task\Domain\Model\DeleteTask;
use Illuminate\Support\Facades\DB;

class DeleteTaskDB implements DeleteTask
{
    private $conection = 'mysql';
    private $categories_tasks = 'categories_tasks';
    private $tasks = 'tasks';
    public function delete($id)
    {
        $taskId = $id['taskId'];

             DB::connection($this->conection)
            ->table($this->categories_tasks)
            ->where('task_id', $taskId)
            ->delete();
            return DB::connection($this->conection)
            ->table($this->tasks)
            ->where('id', $taskId)
            ->delete();
    }
}