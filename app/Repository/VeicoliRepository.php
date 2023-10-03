<?php

namespace App\Repository;

use App\Factory\VeicoloFactory;
use App\LocalModels\Veicolo;
use Illuminate\Support\Arr;

class VeicoliRepository extends Repository
{
    protected array $items = [];
    private string $path;

    public function __construct()
    {
        $this->path = storage_path() . "/local/veicoli.csv";
        $this->load();

    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');

            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $veicolo = VeicoloFactory::create([
                        'id' => Arr::get($data, 0),
                        'targa' => Arr::get($data, 1),
                        'marca' => Arr::get($data, 2),
                        'modello' => Arr::get($data, 3),
                        'parcheggio_id' => Arr::get($data, 4)
                    ]);

                    $this->items[] = $veicolo;
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

        /** @var Veicolo $veicolo */
        foreach ($this->items as $veicolo) {
            if ($veicolo instanceof Veicolo) {
                fputcsv($file, [
                    $veicolo->id,
                    $veicolo->targa,
                    $veicolo->marca,
                    $veicolo->modello,
                    $veicolo->parcheggio_id
                ]);
            }
        }

        fclose($file);
    }
}
