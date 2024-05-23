<?php

namespace App\Domain\Repository;

use App\Domain\Entity\IEntity;

interface IRepository
{
    public function create(array $vals) : int;
    public function get() : array;
    public function first() : ?IEntity;
    public function count() : int;
    public function update(IEntity $modelObject) : void;
    public function delete(int $objectId) : void;
    public function where(string $col, mixed $val) : Repository;
    public function whereIn(string $col, array $vals) : Repository;
    public function getHasMany(int $modelId, string $modelRepository, string $key) : array;
    public function getBelogsTo(int $modelId, string $modelRepository, string $key) : IEntity;
    public function getBelogsToMany(int $modelId, string $modelRepository, string $table, string $mKey, string $rKey, array $pivot = []) : array;
    public function setBelogsToMany(int $modelId, array $data, string $modelRepository, string $table, string $mKey, string $rKey, array $pivot = []) : void;
    public function rawQuery(string $query, array $params = []): array;
}
