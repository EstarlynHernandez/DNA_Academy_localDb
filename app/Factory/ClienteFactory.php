<?php

namespace App\Factory;

use App\LocalModels\Cliente;
use Illuminate\Support\Arr;

class ClienteFactory
{
    public static function create(array $dati): Cliente
    {
        $cliente = new Cliente();
        $cliente->id = Arr::get($dati, 'id', uniqid());
        $cliente->nome = Arr::get($dati, 'nome', 'unknown');
        $cliente->cognome = Arr::get($dati, 'cognome', 'unknown');
        $cliente->email = Arr::get($dati, 'email', 'email@example.com');

        return $cliente;
    }
}
