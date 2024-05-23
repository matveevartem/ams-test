<?php

namespace App;

use Dotenv\Dotenv;
use App\Presentation\Http\Controllers\AppController;
use App\Presentation\Http\Controllers\CarController;
use App\Presentation\Http\Controllers\TaskController;
use App\Infrastructure\Database\MysqlDatabase;
use App\Presentation\Http\Router\Router;
use App\Presentation\Http\Response\Abort;
use App\Application\Database\Migrate;

final class Application
{
    const DB_MYSQL = 'mysql';
    const DB_PGSQL = 'pgsql';

    private static ?Application $instance = null;
    private bool $f_loadEnv= false;
    private bool $f_setRoutesFlag = false;

    private function __construct() {}

    private function __clone() {}

    /**
     * Loads environments from .env file
     * @return void
     */
    private function loadEnv(): void
    {
        if ($this->f_loadEnv) {
            return;
        }

        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $this->f_loadEnv = true;
    }

    /**
     * Sets web routes
     * @return void
     */
    private function setRoutes(): void
    {
        if ($this->f_setRoutesFlag) {
            return;
        }

        Router::get('/', [AppController::class, 'index']);

        Router::get('/car/body-type', [CarController::class, 'getBodyTypeAll']);
        Router::get('/car/:id', [CarController::class, 'getCar']);

        Router::get('/tasks', [TaskController::class, 'tasks']);

        Router::get('/task/task11', [TaskController::class, 'task11']);
        Router::post('/task/task11', [TaskController::class, 'task11']);

        Router::get('/task/task12', [TaskController::class, 'task12']);
        Router::post('/task/task12', [TaskController::class, 'task12']);

        Router::get('/task/task2', [TaskController::class, 'task2']);
        
        Abort::notFound();

        $this->f_setRoutesFlag = true;
    }

    /**
     * Returns database class name
     * @return string
     * @throws \Exception
     */
    private function getTypeDB(): string
    {
        switch (getenv('DB_TYPE')) {
            case self::DB_MYSQL:
                return MysqlDatabase::class;
            case self::DB_PGSQL:
                // не реализовано
                break;
        }

        throw new \Exception('Incorrect database');
    }

    /**
     * Returns an instance of itself
     * @return Application
     */
    public static function getInstance(): Application
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Launches the application
     * @return void
     */
    public function run(): void
    {
        $this->loadEnv();
        $this->setRoutes();
    }

    /**
     * Applies DB migrations
     * @return bool
     */
    public function migrate(): bool
    {
        $this->loadEnv();

        $dbClass = $this->getTypeDB();

        $migrate = new Migrate(new $dbClass());
        return $migrate->up();
    }
}
