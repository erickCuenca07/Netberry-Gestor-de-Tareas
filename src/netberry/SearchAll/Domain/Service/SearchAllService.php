<?php

namespace SearchAll\Domain\Service;

use SearchAll\Domain\Model\InsertAll;

class SearchAllService
{
    private function __construct(private InsertAll $insertAll) {}

    public function execute(): array
    {
        return $this->insertAll->execute();
    }
}