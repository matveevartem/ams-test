<?php

namespace App\Presentation\Http\Controllers;

use App\Infrastructure\Database\MysqlDatabase;

abstract class Controller
{
    protected readonly string $mysqlDatabase;

    final public function __construct()
    {  
        $this->mysqlDatabase = MysqlDatabase::class;
    }

    final protected function getJsonBody() : array
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
