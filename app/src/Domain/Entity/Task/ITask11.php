<?php

namespace App\Domain\Entity\Task;

use App\Domain\Entity\IEntity;

Interface ITask11 extends IEntity
{
    public function getModelId(): int;
    public function getMarkName(): string;
    public function getModelName(): string;
    public function getEndTime(): string|bool;
}
