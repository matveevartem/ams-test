<?php

namespace App\Domain\Entity;

abstract class Entity implements IEntity
{
    protected array $cols;

    final public function getCols(): array
    {
        return $this->cols;
    }
}
