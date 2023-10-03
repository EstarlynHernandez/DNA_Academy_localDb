<?php

namespace App\Management;

use App\Repository\FornitoriRepository;
use App\Repository\ProdottiRepository;
use App\Repository\Repository;

class ProdottiManagement extends Management
{
    /** @var ProdottiRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['nome', 'fornitore_id'];

    public function __construct(ProdottiRepository $repository, FornitoriRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }
}
