<?php

namespace App\Management;

use App\Repository\FornitoriRepository;
use App\Repository\ProdottiRepository;
use App\Repository\Repository;

class FornitoriManagement extends Management
{
    /** @var FornitoriRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['nome', 'email', 'telefono'];

    public function __construct(FornitoriRepository $repository, ProdottiRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }

}
