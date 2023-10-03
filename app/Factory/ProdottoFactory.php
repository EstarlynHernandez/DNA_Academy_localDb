<?php

namespace App\Factory;

use App\LocalModels\Prodotto;
use Illuminate\Support\Arr;

class ProdottoFactory
{
    public static function create($dati): Prodotto
    {
        $prodotto = new Prodotto();

        $prodotto->id = Arr::get($dati, 'id', uniqid());
        $prodotto->nome = Arr::get($dati, 'nome', 'unknown');
        $prodotto->prezzo = Arr::get($dati, 'prezzo', '0');
        $prodotto->quantita = Arr::get($dati, 'quantita', '0');
        $prodotto->fornitore_id = Arr::get($dati, 'fornitore_id', '');

        return $prodotto;
    }
}
