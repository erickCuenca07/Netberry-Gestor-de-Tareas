<?php

namespace SearchAll\Domain\Service;

use SearchAll\Domain\Model\InsertAll;

class InsertAllService
{
    public function __construct(private InsertAll $insertAll)
    {} 
    public function execute($data)
    {
        return $this->insertAll->insertAll($data);
    }
}