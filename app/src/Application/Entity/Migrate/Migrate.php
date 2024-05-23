<?php

namespace App\Application\Entity\Migrate;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Migrate\IMigrate;

class Migrate extends Entity implements IMigrate
{
   protected array $cols = [];
}
