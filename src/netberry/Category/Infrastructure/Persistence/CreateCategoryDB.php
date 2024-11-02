<?php

namespace Category\Infrastructure\Persistence;

use Category\Domain\Model\CreateCategory;
use Illuminate\Support\Facades\DB;

class CreateCategoryDB  implements CreateCategory
{
    private $conection = 'mysql';
    private $table = 'categories';
    public function create($category)
    {
        $category = $category['name'];
        $id = DB::connection($this->conection)
        ->table($this->table)->insertGetId([
            'name' => $category
        ]);
        return DB::connection($this->conection)
        ->table($this->table)->find($id);
    }
}
