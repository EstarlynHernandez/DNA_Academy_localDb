<?php

namespace App\Management;

use App\Repository\ClientiRepository;
use App\Repository\Repository;
use App\Repository\OrdiniRepository;
class OrdiniManagement extends Management
{
    /** @var OrdiniRepository $repository */
    protected Repository $repository;
    protected Repository $externalRepository;
    protected array $searchable = ['totale', 'cliente_id'];

    public function __construct(OrdiniRepository $repository, ClientiRepository $prodottiRepository)
    {
        $this->repository = $repository;
        $this->externalRepository = $prodottiRepository;
    }
}
