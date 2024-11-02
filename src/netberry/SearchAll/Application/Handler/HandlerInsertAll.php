<?php

namespace SearchAll\Application\Handler;

use SearchAll\Domain\Service\InsertAllService;

class HandlerInsertAll
{
    public function __construct(private InsertAllService $insertAllService){}

    public function handle($data): mixed
    {
        return $this->insertAllService->execute($data);
    }
}