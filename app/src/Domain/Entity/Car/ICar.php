<?php

namespace App\Domain\Entity\Car;

use App\Domain\Entity\IEntity;

interface ICar extends IEntity
{
    public function getModelId(): int;
    public function getMarkId(): int;
    public function getBodyTypeId(): int;
    public function getBodyTypeName(): string;
    public function getModelName(): string;
    public function getMarkName(): string;
    public function getTimeStart(bool $needFormat = false): string;
    public function getTimeEnd(bool $needFormat = false): string;
    public function getWorks(): ?array;
}
