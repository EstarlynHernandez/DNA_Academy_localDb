<?php

namespace App\Management;

use App\Repository\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class Management
{
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = [];

    public function filter($by, $min = 0, $max = INF, $object = null): array
    {
        $items = $object ?? $this->repository->getAll();
        return array_filter($items, function ($item) use ($min, $by, $max) {
            if ($item->{$by} >= $min && $item->{$by} <= $max) {
                return true;
            }
            return false;
        });
    }

    public function search($string, $object = null): array
    {
        $items = $object ?? $this->repository->getAll();
        $string = strtolower($string);
        $searchable = $this->searchable;
        if (strlen($string) < 1) {
            return $items;
        }

        return array_filter($items, function ($item) use ($searchable, $string) {
            foreach ($searchable as $search) {
                if (Str::contains(strtolower($item->{$search}), strtolower($string))) {
                    return true;
                }
            }

            return false;
        });
    }

    public function orderBy(string $orderBy, bool $asc = true, $object = null): array
    {
        $order = $asc ? 'sort' : 'sortDesc';
        $items = $object ?? $this->repository->getAll();

        return Arr::{$order}($items, fn($item) => $item->{$orderBy});
    }

    public function removeGroup(string $removeBy, $min = 0, $object = null): void
    {
        $items = $object ?? $this->repository->getAll();
        $removeItems = array_filter($items, function ($item) use ($removeBy, $min){
            if ($item->{$removeBy} <= $min) {
                return true;
            }
            return false;
        });

        $this->repository->deleteGroup($removeItems);
    }

    public function findForeignKey(string $id, string $foreignKey)
    {
        $item = $this->repository->find($id);
        return $this->externalRepository->find($item->{$foreignKey});
    }

    public function hasMany(string $id, string $foreignKey): array
    {
        $externalItems = $this->externalRepository->getAll();
        $item = $this->repository->find($id);

        return array_filter($externalItems, fn ($externalItem) => $externalItem->{$foreignKey} == $item->id);
    }
}
