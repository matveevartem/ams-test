<?php

namespace App\Application\Entity\Car;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Car\ICar;
use \DateTimeImmutable;
use \IntlDateFormatter;
use \NumberFormatter;

class Car extends Entity implements ICar
{
    public int $modelId;
    public int $markId;
    public int $bodyTypeId;
    public ?int $workId;
    public string $modelName;
    public string $markName;
    public string $bodyTypeName;
    public ?string $workName;
    public ?float $workCost;
    public ?float $workTime;
    public string $timeStart;
    public string $timeEnd;

    protected array $cols = [
        'modelId',
        'markId',
        'bodyTypeId',
        'workId',
        'modelName',
        'markName',
        'bodyTypeName',
        'timeStart',
        'timeEnd',
        'workName',
        'workCost',
        'workTime',
    ];

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function getMarkId(): int
    {
        return $this->markId;
    }

    public function getBodyTypeId(): int
    {
        return $this->bodyTypeId;
    }

    public function getWorkId(): ?int
    {
        return $this->workId;
    }

    public function getBodyTypeName(): string
    {
        return $this->bodyTypeName;
    }

    public function getModelName(): string
    {
        return $this->modelName;
    }

    public function getMarkName(): string
    {
        return $this->markName;
    }

    public function getTimeStart(bool $needFormat = false): string
    {
        $timeStart = $this->timeStart;

         if ( $needFormat) {
            $date = new DateTimeImmutable($this->timeStart);
            $intlFormatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
            $intlFormatter->setPattern('MMM YYYY');
            $timeStart = $intlFormatter->format($date);
        }

        return $timeStart;
    }

    public function getTimeEnd(bool $needFormat = false): string
    {
        $timeEnd = $this->timeEnd;

        if ($this->timeEnd === '2038-01-19 03:14:07') {
            $timeEnd = 'по настоящее время';
        } elseif ( $needFormat) {
            $date = new DateTimeImmutable($this->timeEnd);
            $intlFormatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
            $intlFormatter->setPattern('MMM YYYY');
            $timeEnd = $intlFormatter->format($date);
        }

        return $timeEnd;
    }

    public function getWorkName(): ?string
    {
        return $this->workName;
    }

    public function getWorkCost(bool $needFormat = false): float|string|null
    {
        if (!$this->workCost) {
            return null;
        }

        $formatter = new NumberFormatter("ru-RU", NumberFormatter::CURRENCY);

        return $needFormat ? $formatter->format($this->workCost) : $this->workCost;
    }

    public function getWorkTime(): ?float
    {
        return $this->workTime;
    }
}
