<?php

namespace App\Management;

use App\Repository\Repository;
use App\Repository\QuadriRepository;
use App\Repository\ArtistiRepository;

class QuadriManagement extends Management
{
    /** @var QuadriRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['titolo', 'artista_id'];

    public function __construct(QuadriRepository $repository, ArtistiRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }

}
