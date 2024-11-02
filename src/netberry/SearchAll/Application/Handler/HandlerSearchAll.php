<?php

namespace SearchAll\Application\Handler;

use SearchAll\Domain\Service\SearchAllService;

class HandlerSearchAll
{
    public function __construct(private SearchAllService $searchAllService) {}

    public function handle(): array
    {
        return $this->searchAllService->execute();
    }
}