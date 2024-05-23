<?php

namespace App\Domain\Repository;

use App\Domain\Repository\IRepository;

interface ICarBodyTypeRepository extends IRepository
{
    public function __construct(string $db);
}
