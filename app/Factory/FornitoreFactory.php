<?php

namespace App\Factory;

use App\LocalModels\Fornitore;
use Illuminate\Support\Arr;

class FornitoreFactory
{
    public static function create(array $dati): Fornitore
    {
        $fornitore = new Fornitore();

        $fornitore->id = Arr::get($dati, 'id', uniqid());
        $fornitore->nome = Arr::get($dati, 'nome', 'unknown');
        $fornitore->email = Arr::get($dati, 'email', 'email@example.com');
        $fornitore->telefono = Arr::get($dati, 'telefono', '123456789');

        return $fornitore;
    }
}
