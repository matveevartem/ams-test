<?php

namespace App\Domain\Entity\Car;

use App\Domain\Entity\IEntity;

Interface ICarBodyType extends IEntity
{
    public function getId(): int;
    public function getName(): string;
    public function getImage(): string;
}
