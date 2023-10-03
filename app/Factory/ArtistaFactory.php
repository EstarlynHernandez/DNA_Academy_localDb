<?php

namespace App\Factory;

use App\LocalModels\Artista;
use Illuminate\Support\Arr;

class ArtistaFactory
{
    public static function create($data): Artista
    {
        $artista = new Artista();
        $artista->id = Arr::get($data, 'id', uniqid());
        $artista->nome = Arr::get($data, 'nome', 'unknown');
        $artista->anno_nascita = Arr::get($data, 'anno_nascita');
        $artista->nazione = Arr::get($data, 'nazione', 'unknown');

        return $artista;
    }
}
