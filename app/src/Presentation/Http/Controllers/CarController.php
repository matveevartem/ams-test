<?php

namespace App\Presentation\Http\Controllers;

use App\Infrastructure\Repository\CarRepository;
use App\Infrastructure\Repository\CarBodyRepository;
use App\Infrastructure\Repository\TaskRepository;
use App\Presentation\Http\Response\Response;
use App\Domain\Entity\Task\TaskType;
use App\Presentation\Http\Response\Abort;

class CarController extends Controller
{
    public function getCar($id)
    {
        $data = (new CarRepository($this->mysqlDatabase))->getCar($id);

        if (empty($data)) {
            Abort::notFound();
        }

        $car = [
            'modelId' => $data[0]->getModelId(),
            'markId' => $data[0]->getMarkId(),
            'bodyTypeId' => $data[0]->getBodyTypeId(),
            'modelName' => $data[0]->getModelName(),
            'markName' => $data[0]->getMarkName(),
            'bodyTypeName' => $data[0]->getBodyTypeName(),
            'timeStart' => $data[0]->getTimeStart(true),
            'timeEnd' => $data[0]->getTimeEnd(true),
            'works' => $data[0]->getWorks(),
        ];

        Response::json($car);
    }

    public function getBodyTypeAll()
    {
        $data = (new CarBodyRepository($this->mysqlDatabase))->getAll();

        if (empty($data)) {
            Abort::notFound();
        }

        $typeAll = [];

        foreach ($data as $type) {
            $typeAll[] = [
                'id' => $type->getId(),
                'name' => $type->getName(),
                'image' => $type->getImage(),
            ];
        }

        Response::json($typeAll);
    }
}
