<?php

namespace Category\Domain\Service;

use Category\Domain\Model\GetCategory;

class ServiceGetCategory
{
    public function __construct(private GetCategory $getCategory) {}
    
    public function execute(): array
    {
        return $this->getCategory->getCategory();
    }
}