<?php

namespace App\LocalModels;

class Ordine
{
    public string $id;
    public \DateTime $data;
    public int $totale;
    public string $cliente_id;
}
