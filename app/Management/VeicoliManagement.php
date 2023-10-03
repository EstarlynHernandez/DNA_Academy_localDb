<?php

namespace App\Management;
use App\Repository\ParcheggiRepository;
use App\Repository\Repository;
use App\Repository\VeicoliRepository;

class VeicoliManagement extends Management
{
    /** @var VeicoliRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['targa', 'marca', 'modello', 'parcheggio_id'];

    public function __construct(VeicoliRepository $repository, ParcheggiRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }
}
