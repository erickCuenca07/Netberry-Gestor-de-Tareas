<?php

namespace Task\Infrastructure\Persistence;

use Task\Domain\Model\GetTask;
use Illuminate\Support\Facades\DB;

class GetTaskDB implements GetTask
{
    private $connection = 'mysql';
    private $tasks = 'tasks';
    private $categories = 'categories';
    private $categories_tasks = 'categories_tasks';
    public function getTask(): array
    {
        return DB::connection($this->connection)
        ->table($this->tasks. ' as t')   
        ->join($this->categories_tasks. ' as ct', 't.id', '=', 'ct.task_id')
        ->join($this->categories. ' as c', 'ct.category_id', '=', 'c.id')
        ->select('t.id as taskId', 't.name as taskName', 'c.name as categoryName')
        ->get()
        ->groupBy('taskId')
        ->toArray();
    }
}