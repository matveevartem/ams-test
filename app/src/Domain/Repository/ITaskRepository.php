<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Car\ICarBodyType;
use App\Domain\Repository\IRepository;
use App\Domain\Entity\Task\TaskType;

interface ITaskRepository extends IRepository
{
    public function __construct(string $db, TaskType $taskType);

    public function getTask11(?\DateTimeInterface $dateEnd = null): array;
    public function getTask12(?float $cost = null): array;
    public function getTask2(?ICarBodyType $bodyType = null): array;
}
