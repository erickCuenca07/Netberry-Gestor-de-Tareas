<?php

namespace SearchAll\Infrastructure\Entrypoint\Http;

use Category\Application\Handler\HandlerGetCategory;
use Category\Domain\Service\ServiceGetCategory;
use Category\Infrastructure\Persistence\GetCategoryDB;
use Task\Application\Handler\HandlerGetTask;
use Task\Application\Handler\HandlerDeleteTask;
use Task\Application\Handler\HandlerInsertTask;
use Task\Domain\Service\ServiceDeleteTask;
use Task\Domain\Service\ServiceGetTask;
use Task\Domain\Service\ServiceInsertTask;
use Task\Infrastructure\Persistence\InsertTaskDB;
use Task\Infrastructure\Persistence\GetTaskDB;
use Task\Infrastructure\Persistence\DeleteTaskDB;
use SearchAll\Application\Handler\HandlerInsertAll;
use SearchAll\Domain\Service\InsertAllService;
use SearchAll\Infrastructure\Persistence\InsertAllDB;
use Inertia\Inertia;
use Illuminate\Http\Request;
class SearchAllController
{
    public function index()
    {
        return Inertia::render('Dashboard',[
            'categories' => (new HandlerGetCategory(new ServiceGetCategory(new GetCategoryDB())))->handle(),
            'tasks' => (new HandlerGetTask(new ServiceGetTask(new GetTaskDB())))->handle(),
        ]);
    }

    public function createAndGet(Request $request)
    {
        $task = $request->input('task');
        $category = $request->input('categories');
        $insertTask = (new HandlerInsertTask(new ServiceInsertTask(new InsertTaskDB())))->handle($task);
        return $this->insertAll($insertTask, $category);
    }
    public function insertAll($insertTask, $category)
    {
        $data = ['task' => $insertTask, 'categories' => $category];
        return (new HandlerInsertAll(new InsertAllService(new InsertAllDB())))->handle($data);
    }

    public function delete(Request $request)
    {
        $taskId = $request->input('task');
        return (new HandlerDeleteTask(new ServiceDeleteTask(new DeleteTaskDB())))->handle($taskId);
    }    

}