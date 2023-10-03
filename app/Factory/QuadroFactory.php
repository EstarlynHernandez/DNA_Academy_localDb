<?php

namespace App\Factory;

use App\LocalModels\Quadro;
use Illuminate\Support\Arr;

class QuadroFactory
{
    public static function create($data): Quadro
    {
        $veicolo = new Quadro();
        $veicolo->id = Arr::get($data, 'id', uniqid());
        $veicolo->titolo = Arr::get($data, 'titolo', 'unknown');
        $veicolo->anno = Arr::get($data, 'anno', 0);
        $veicolo->artista_id = Arr::get($data, 'artista_id', 'unknown');

        return $veicolo;
    }
}
