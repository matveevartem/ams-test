<?php

namespace App\Application\Entity\Task;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Task\ITask12;
use \NumberFormatter;

class Task12 extends Entity implements ITask12
{
    public int $modelId;
    public string $markName;
    public string $modelName;
    public string $workName;
    public float $workCost;
    public float $workTime;

    protected array $cols = ['modelId', 'markName', 'modelName', 'workName', 'workCost', 'workTime'];

    public function getModelId(): int
    {
        return $this->modelId;
    }
    public function getModelName(): string
    {
        return $this->modelName;
    }
    public function getMarkName(): string
    {
        return $this->markName;
    }

    public function getWorkName(): string
    {
        return $this->workName;
    }

    public function getWorkTime(): float
    {
        return $this->workTime;
    }

    /**
     * @param bool $needFormat if false will return float else will return string as local currency format
     */
    public function getWorkCost(bool $needFormat = false): float|string
    {
        $formatter = new NumberFormatter("ru-RU", NumberFormatter::CURRENCY);

        return $needFormat ? $formatter->format($this->workCost) : $this->workCost;
    }
}
