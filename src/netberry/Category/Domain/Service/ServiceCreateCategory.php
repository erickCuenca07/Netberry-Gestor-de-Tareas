<?php

namespace Category\Domain\Service;

use Category\Domain\Model\CreateCategory;

class ServiceCreateCategory
{
    public function __construct(private CreateCategory $createCategory) {} 

    public function execute($category)
    {
        return $this->createCategory->create($category);
    } 
}