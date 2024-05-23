<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Task\TaskType;
use App\Domain\Repository\Repository;
use App\Domain\Repository\ICarBodyTypeRepository;
use App\Application\Entity\Car\CarBodyType;

class CarBodyRepository extends Repository implements ICarBodyTypeRepository
{
    public function __construct(string $db)
    {
        parent::__construct(new CarBodyType(), $db);
    }

    public function getAll()
    {
        $sql = "SELECT id, name, image FROM car_body_type";

        return $this->rawQuery($sql, []);
    }
}
