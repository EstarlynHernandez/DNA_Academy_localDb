<?php

namespace App\Management;

use App\Repository\QuadriRepository;
use App\Repository\Repository;
use App\Repository\ArtistiRepository;

class ArtistiManagement extends Management
{
    /** @var ArtistiRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['nome', 'nazione'];

    public function __construct(ArtistiRepository $repository, QuadriRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }
}
