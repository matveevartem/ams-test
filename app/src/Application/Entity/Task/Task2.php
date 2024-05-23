<?php

namespace App\Application\Entity\Task;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Task\ITask2;

class Task2 extends Entity implements ITask2
{
    public int $modelId;
    public int $bodyTypeId;
    public string $modelName;
    public string $markName;
    public string $bodyTypeName;
    public string $image;

    protected array $cols = ['modelId', 'bodyTypeId', 'modelName', 'markName', 'bodyTypeName', 'image'];

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function bodyTypeId(): int
    {
        return $this->bodyTypeId;
    }

    public function getBodyTypeId(): int
    {
        return $this->bodyTypeId;
    }

    public function getModelName(): string
    {
        return $this->modelName;
    }

    public function getMarkName(): string
    {
        return $this->markName;
    }

    public function getBodyTypeName(): string
    {
        return $this->bodyTypeName;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
