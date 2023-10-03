<?php

namespace App\Repository;

use App\Factory\ClienteFactory;
use Illuminate\Support\Arr;
use App\LocalModels\Cliente;

class ClientiRepository extends Repository
{
    protected array $items = [];
    private string $path;

    public function __construct()
    {
        $this->path = storage_path() . "/local/clienti.csv";
        $this->load();

    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');

            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $prodotto = ClienteFactory::create([
                        'id' => Arr::get($data, 0),
                        'nome' => Arr::get($data, 1),
                        'cognome' => Arr::get($data, 2),
                        'email' => Arr::get($data, 3),
                    ]);

                    $this->items[] = $prodotto;
                }
            }

            fclose($file);
        }

    }

    protected function save(): void
    {
        if (!file_exists(storage_path() . "/local")) {
            mkdir(storage_path() . "/local");
        }

        $file = fopen($this->path, 'w+');

        /** @var Cliente $cliente */
        foreach ($this->items as $cliente) {
            if ($cliente instanceof Cliente) {
                fputcsv($file, [
                    $cliente->id,
                    $cliente->nome,
                    $cliente->cognome,
                    $cliente->email
                ]);
            }
        }

        fclose($file);
    }
}
