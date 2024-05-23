<?php

namespace App\Domain\Entity\Task;

use App\Domain\Entity\IEntity;

Interface ITask12 extends IEntity
{
    public function getModelId(): int;
    public function getModelName(): string;
    public function getMarkName(): string;
    public function getWorkName(): string;
    public function getWorkTime(): float;
    public function getWorkCost(bool $needFormat = false): float|string;
}