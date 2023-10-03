<?php

namespace App\Management;

use App\Repository\Repository;
use App\Repository\ParcheggiRepository;
use App\Repository\VeicoliRepository;

class ParcheggiManagement extends Management
{
    /** @var ParcheggiRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['nome', 'indirizzo'];

    public function __construct(ParcheggiRepository $repository, VeicoliRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }
}
