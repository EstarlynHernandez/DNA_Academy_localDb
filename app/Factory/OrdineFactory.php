<?php

namespace App\Factory;

use App\LocalModels\Ordine;
use Illuminate\Support\Arr;

class OrdineFactory
{
    public static function create(array $dati): Ordine
    {
        $ordine = new Ordine();

        $ordine->id = Arr::get($dati, 'id', uniqid());
        $ordine->data = Arr::get($dati, 'data', new \DateTime);
        $ordine->totale = Arr::get($dati, 'totale', '00');
        $ordine->cliente_id = Arr::get($dati, 'cliente_id', '');

        return $ordine;
    }
}
