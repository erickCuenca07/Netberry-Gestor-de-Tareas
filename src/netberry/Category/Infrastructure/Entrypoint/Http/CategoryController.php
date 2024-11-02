<?php

namespace Category\Infrastructure\Entrypoint\Http;

use Category\Application\GetCategoryDB;
use Category\Application\HandlerGetCategory;
use Category\Application\ServiceGetCategory;
use Category\Infrastructure\Persistence\CreateCategoryDB;
use Category\Domain\Service\ServiceCreateCategory;
use Category\Application\Handler\HandlerCreateCategory;
use Illuminate\Http\Request;
class CategoryController
{
    public function getCategory()  
    {
        return (new HandlerGetCategory(new ServiceGetCategory(new GetCategoryDB())))->handle();
    }
    public function create(Request $request)
    {
        $data = ['name' => $request->name];
        return (new HandlerCreateCategory(new ServiceCreateCategory(new CreateCategoryDB())))->handle($data);
    }
}