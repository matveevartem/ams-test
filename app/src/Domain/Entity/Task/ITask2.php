<?php

namespace App\Domain\Entity\Task;

use App\Domain\Entity\IEntity;

Interface ITask2 extends IEntity
{
    public function getModelId(): int;
    public function bodyTypeId(): int;
    public function getBodyTypeId(): int;
    public function getModelName(): string;
    public function getMarkName(): string;
    public function getBodyTypeName(): string;
    public function getImage(): string;
}
