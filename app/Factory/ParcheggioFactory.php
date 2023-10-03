<?php

namespace App\Factory;

use App\LocalModels\Parcheggio;
use Illuminate\Support\Arr;

class ParcheggioFactory
{
    public static function create($data): Parcheggio
    {
        $parcheggio = new Parcheggio();
        $parcheggio->id = Arr::get($data, 'id', uniqid());
        $parcheggio->nome = Arr::get($data, 'nome', 'unknown');
        $parcheggio->indirizzo = Arr::get($data, 'indirizzo', 'unknown');

        return $parcheggio;
    }
}
