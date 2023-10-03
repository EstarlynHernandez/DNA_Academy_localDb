<?php

namespace App\Repository;

abstract class Repository
{
    protected array $items = [];

    public function getAll(): array
    {
        return $this->items;
    }

    public function insert($nuovoItem): bool
    {
        foreach ($this->items as $item) {
            if ($item->id == $nuovoItem->id) {
                return false;
            }
        }

        $this->items[] = $nuovoItem;
        $this->save();

        return true;
    }

    protected function save(): void{}

    public function find($id)
    {
        foreach ($this->items as $item) {
            if ($item->id == $id) {
                return $item;
            }
        }

        return false;
    }

    public function delete($id): bool
    {
        foreach ($this->items as $key => $item) {
            if ($item->id == $id) {
                unset($this->items[$key]);
                $this->save();
                return true;
            }
        }

        return false;
    }

    public function deleteGroup(array $delItems): bool
    {
        foreach ($this->items as $key => $item) {
            foreach ($delItems as $delItem) {
                if ($item->id == ($delItem->id ?? $delItem)) {
                    unset($this->items[$key]);
                }
            }
        }

        $this->save();

        return true;
    }

    public function update($nuovoItem): bool
    {
        foreach ($this->items as $key => $item) {
            if ($item->id == $nuovoItem->id) {
                $this->items[$key] = $nuovoItem;
                $this->save();
                return true;
            }
        }

        return false;
    }

    protected function load(): void{}
}
