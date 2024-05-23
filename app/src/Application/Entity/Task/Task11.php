<?php

namespace App\Application\Entity\Task;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Task\ITask11;
use DateTimeImmutable;
use IntlDateFormatter;

class Task11 extends Entity implements ITask11
{
    public int $modelId;
    public string $markName;
    public string $modelName;
    public string $endTime;

    protected array $cols = ['modelId', 'markName', 'modelName', 'endTime'];

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function getMarkName(): string
    {
        return $this->markName;
    }

    public function getModelName(): string
    {
        return $this->modelName;
    }

    public function getEndTime(): string|bool
    {
        $timeEnd = $this->endTime;

        if ($this->endTime === '2038-01-19 03:14:07') {
            $timeEnd = 'по настоящее время';
        } else {
            $date = new DateTimeImmutable($this->endTime);
            $intlFormatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
            $intlFormatter->setPattern('dd MMM YYYY');
            $timeEnd = $intlFormatter->format($date);
        }

        return $timeEnd;
    }
}
