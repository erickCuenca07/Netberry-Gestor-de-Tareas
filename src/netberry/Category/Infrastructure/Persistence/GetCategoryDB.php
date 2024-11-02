<?php

namespace Category\Infrastructure\Persistence;

use Category\Domain\Model\GetCategory;
use Illuminate\Support\Facades\DB;

class GetCategoryDB implements GetCategory
{
    private $connection = 'mysql';
    private $table = 'categories';
    public function getCategory(): array
    {
        return DB::connection($this->connection)
        ->table($this->table. ' as c')
        ->select('c.id', 'c.name')
        ->get()
        ->map(fn ($item) => $this->mapGetCategory($item))
        ->toArray();
    }
    public function mapGetCategory($item): mixed
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
        ];
    }
}