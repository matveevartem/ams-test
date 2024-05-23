<?php

namespace App\Application\Entity\Car;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Car\ICarBodyType;

class CarBodyType extends Entity implements ICarBodyType
{
    public int $id;
    public string $name;
    public string  $image;

    protected array $cols = ['id', 'name', 'image'];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
