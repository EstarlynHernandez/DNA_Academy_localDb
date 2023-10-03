<?php

namespace App\Factory;

use App\LocalModels\Veicolo;
use Illuminate\Support\Arr;

class VeicoloFactory
{
    public static function create($data): Veicolo
    {
        $veicolo = new Veicolo();
        $veicolo->id = Arr::get($data, 'id', uniqid());
        $veicolo->targa = Arr::get($data, 'targa', 'unknown');
        $veicolo->marca = Arr::get($data, 'marca', 'unknown');
        $veicolo->modello = Arr::get($data, 'modello', 'unknown');
        $veicolo->parcheggio_id = Arr::get($data, 'parcheggio_id');

        return $veicolo;
    }
}
