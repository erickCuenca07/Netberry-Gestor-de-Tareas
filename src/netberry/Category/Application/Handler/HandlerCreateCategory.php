<?php

namespace Category\Application\Handler;

use Category\Domain\Service\ServiceCreateCategory;

class HandlerCreateCategory
{
    public function __construct(private ServiceCreateCategory $serviceCreateCategory){}

    public function handle($category)
    {
        return $this->serviceCreateCategory->execute($category);    
    }
}