<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Car\ICarBodyType;
use App\Domain\Entity\Task\TaskType;
use App\Domain\Repository\Repository;
use App\Domain\Repository\ITaskRepository;
use App\Application\Entity\Task\Task11;
use App\Application\Entity\Task\Task12;
use App\Application\Entity\Task\Task2;

class TaskRepository extends Repository implements ITaskRepository
{
    /**
     * @param string $db database class
     * @param TaskType $taskType task type
     */
    public function __construct(string $db, TaskType $taskType)
    {
        switch ($taskType) {
            case TaskType::Task11:
                parent::__construct(new Task11(), $db);
                break;
            case TaskType::Task12:
                parent::__construct(new Task12(), $db);
                break;
            case TaskType::Task2:
                parent::__construct(new Task2(), $db);
                break;
            default:
                throw new \InvalidArgumentException('Invalid task');
        }
    }

    /**
     * Запрос в БД для Task 1-1
     * @return array
     */
    public function getTask11(?\DateTimeInterface $dateEnd = null): array
    {
        if (!$dateEnd) {
            $dateEnd = new \DateTimeImmutable('2038-01-19 03:14:07');
        }

        $sql = "SELECT
                    mdl.id as modelId,
                    mrk.name as markName,
                    mdl.name as modelName,
                    mdl.date_end as endTime 
                FROM car_model mdl
                INNER JOIN car_mark mrk ON (mrk.id = mdl.mark_id)
                WHERE mdl.date_end <= :dateEnd";

        return $this->rawQuery($sql, [
            ":dateEnd" => $dateEnd->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Запрос в БД для Task 1-2
     * @return array
     */
    public function getTask12(?float $cost = null): array
    {
        $cost = $cost ?: 1000;

        $sql = "SELECT 
                mdl.id as modelId,
                mrk.name as markName,
                mdl.name as modelName,
                wrk.name as workName,
                wrk.cost as workCost,
                wrk.time as workTime
            FROM car_model mdl
            INNER JOIN car_mark mrk ON(mrk.id = mdl.mark_id)
            INNER JOIN car_work wrk ON(wrk.model_id = mdl.id)
            WHERE NOW() BETWEEN mdl.date_start AND mdl.date_end
            AND wrk.cost > :cost";

        return $this->rawQuery($sql, [
            ':cost' => $cost,
        ]);
    }

    /**
     * Запрос в БД для Task 2
     * @return array
     */
    public function getTask2(?ICarBodyType $bodyType = null): array
    {
        $sql = "SELECT
            mdl.id as modelId,
            bdt.id as bodyTypeId,
            mrk.id as markId,
            mdl.name as modelName,
            mrk.name as markName,
            bdt.name as bodyTypeName,
            mdl.image as image
        FROM car_model mdl
        INNER JOIN car_mark mrk ON(mrk.id = mdl.mark_id)
        INNER JOIN car_body_type bdt ON(bdt.id = mdl.body_type_id)";

        return $this->rawQuery($sql);
    }
}
