<?php

namespace App\Management;

use App\Repository\ClientiRepository;
use App\Repository\OrdiniRepository;
use App\Repository\Repository;

class ClientiManagement extends Management
{
    /** @var ClientiRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['nome', 'cognome', 'email'];

    public function __construct(ClientiRepository $repository, OrdiniRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }
}
