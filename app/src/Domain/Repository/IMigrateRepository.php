<?php

namespace App\Domain\Repository;

interface IMigrateRepository
{
    public function __construct(string $db);
    public function implement(string $sql): void;
}
