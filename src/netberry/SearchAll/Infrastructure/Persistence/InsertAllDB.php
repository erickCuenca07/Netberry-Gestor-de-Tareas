<?php

namespace SearchAll\Infrastructure\Persistence;

use SearchAll\Domain\Model\InsertAll;
use Illuminate\Support\Facades\DB;

class InsertAllDB  implements InsertAll
{
    private $conection = 'mysql';
    private $tasks = 'tasks';
    private $categories = 'categories';
    private $categories_tasks = 'categories_tasks';
    public function insertAll($data)
    {
        $task = $data['task'];
        $categories = $data['categories'];

        $insertData = $this->PrepareArray($categories, $task);
        
        $this->insertCategoriesTasks($insertData);
        
        return $this->getLastInsert($task);
    }
    private function PrepareArray($categories, $task)
    {
        $insertData = [];
        foreach ($categories as $category) {
            if (isset($category['id'])) {
                $insertData[] = [
                    'task_id' => $task,
                    'category_id' => $category['id'],
                ];
            }
        }
        return $insertData;
    }
    private function insertCategoriesTasks(array $insertData): void
    {
        if (!empty($insertData)) {
            DB::connection($this->conection)
                ->table($this->categories_tasks)
                ->insert($insertData);
        }
    }
    public function getLastInsert($task)
    {
        return DB::connection($this->conection)
        ->table($this->tasks. ' as t')   
        ->join($this->categories_tasks. ' as ct', 't.id', '=', 'ct.task_id')
        ->join($this->categories. ' as c', 'ct.category_id', '=', 'c.id')
        ->select('t.id as taskId', 't.name as taskName', 'c.name as categoryName')
        ->where('ct.task_id', $task)
        ->get()
        ->groupBy('taskId')
        ->toArray();
    }
}
