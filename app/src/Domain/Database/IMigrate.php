<?php

namespace App\Domain\Database;

use App\Domain\Database\IDatabase;

interface IMigrate
{
    public function __construct(IDatabase $db);
    public function up(): bool;
}
