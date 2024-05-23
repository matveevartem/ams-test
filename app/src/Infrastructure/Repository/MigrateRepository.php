<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\IMigrateRepository;
use App\Domain\Repository\Repository;
use App\Application\Entity\Migrate\Migrate;

class MigrateRepository extends Repository implements IMigrateRepository
{
    public function __construct(string $db)
    {
        parent::__construct(new Migrate(), $db);
    }

    public function implement(string $sql): void
    {
        $this->rawQuery($sql);
    }
}
