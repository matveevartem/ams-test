<?php

namespace App\Presentation\Http\Controllers;

use App\Application;
use App\Infrastructure\Repository\TaskRepository;
use App\Infrastructure\Repository\CarBodyRepository;
use App\Presentation\Http\Response\Response;
use App\Presentation\Http\Response\Abort;
use App\Domain\Entity\Task\TaskType;
use App\Application\Validator\Validator;
use Exception;
use DateTimeImmutable;

class TaskController extends Controller
{

    public function tasks()
    {
        Response::view('Task' . DIRECTORY_SEPARATOR . 'Tasks', []);
    }

    public function task11()
    {
        $timeEnd = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                Validator::validate($_POST, [
                    'time-end' => ['required']
                ]);
  
                $timeEnd = new DateTimeImmutable($_POST['time-end']);
            } catch(Exception $e) {
                Abort::badRequest();
            }
        }

        Response::view('Task' . DIRECTORY_SEPARATOR . 'Task-1-1', [
            // для показа всех моделей, указываем макс. дату в mysql)
            'timeEnd' => $timeEnd ?: new DateTimeImmutable('2038-01-19 03:14:07'),
            'cars' => (new TaskRepository($this->mysqlDatabase, TaskType::Task11))->getTask11($timeEnd),
        ]);
    }

    public function task12()
    {
        $minSumm = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                Validator::validate($_POST, [
                    'summ' => ['required']
                ]);

                $minSumm = floatval($_POST['summ']);
            } catch(Exception $e) {
                Abort::badRequest();
            }
        }

        Response::view('Task' . DIRECTORY_SEPARATOR . 'Task-1-2', [
            'filterSumm' => $minSumm ?: 1000,
            'cars' => (new TaskRepository($this->mysqlDatabase, TaskType::Task12))->getTask12($minSumm),
        ]);
    }

    public function task2()
    {
        Response::view('Task' . DIRECTORY_SEPARATOR . 'Task-2', [
            'cars' => (new TaskRepository($this->mysqlDatabase, TaskType::Task2))->getTask2(),
            'menuItems' => (new CarBodyRepository($this->mysqlDatabase))->getAll(),
        ]);
    }
}
