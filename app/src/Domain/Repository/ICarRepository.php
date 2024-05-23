<?php

namespace App\Domain\Repository;

use App\Domain\Repository\IRepository;

interface ICarRepository extends IRepository
{
    public function __construct(string $db);

    public function getCar(int $id): array;
    public function getAll(array $params): array;
}
