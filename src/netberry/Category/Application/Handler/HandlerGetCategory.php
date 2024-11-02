<?php

namespace Category\Application\Handler;

use Category\Domain\Service\ServiceGetCategory;

class HandlerGetCategory
{
    public function __construct(private ServiceGetCategory $serviceGetCategory){}

    public function handle(): array
    {
        return $this->serviceGetCategory->execute();
    }
}