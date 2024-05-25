<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\Repository;
use App\Domain\Repository\ICarRepository;
use App\Application\Entity\Car\Car;

class CarRepository extends Repository implements ICarRepository
{
    public function __construct(string $db)
    {
        parent::__construct(new Car(), $db);
    }

    public function getCar(int $id): array
    {
        $sql = "SELECT
            mdl.id as modelId,
            mdl.name as modelName,
            mdl.date_start as timeStart,
            mdl.date_end as timeEnd,
            mrk.id as markId,
            mrk.name as markName,
            bdt.id as bodyTypeId,
            bdt.name as bodyTypeName,
            CONCAT(
                '[',
                GROUP_CONCAT(
                    JSON_OBJECT(
                        'id', IFNULL(wrk.id, 0),
                        'name', IFNULL(wrk.name, 'Нет доступных видов работ'),
                        'cost', IFNULL(wrk.cost, ''),
                        'time', IFNULL(wrk.time, '')
                    )
                ), 
                ']'
            ) AS works
        FROM car_model mdl
        INNER JOIN car_mark mrk ON(mrk.id = mdl.mark_id)
        INNER JOIN car_body_type bdt ON(bdt.id = mdl.body_type_id) 
        LEFT JOIN car_work wrk ON(wrk.model_id = mdl.id)
        WHERE mdl.id=:id";

        return $this->rawQuery($sql, [
            ':id' => $id,
        ]);
    }
    public function getAll(array $params = []): array
    {
        $sql = "SELECT
            mdl.id as modelId,
            mdl.name as modelName,
            mrk.id as markId,
            mrk.name as markName,
            bdt.id as bodyId,
            bdt.name as bodyName,
            wrk.id as workId,
            wrk.name as workName,
            wrk.cost as workCost,
            wrk.time as workTime
        FROM car_model mdl
        INNER JOIN car_mark mrk ON(mrk.id = mdl.mark_id)
        INNER JOIN car_body_type bdt ON(bdt.id = mdl.body_type_id) 
        LEFT JOIN car_work wrk ON(wrk.model_id = mdl.id)";

        return $this->rawQuery($sql, $params);
    }
}
