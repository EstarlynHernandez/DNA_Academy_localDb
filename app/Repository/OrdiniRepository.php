<?php

namespace App\Repository;

use App\Factory\OrdineFactory;
use Illuminate\Support\Arr;
use App\LocalModels\Ordine;

class OrdiniRepository extends Repository
{
    protected array $items = [];
    private string $path;

    public function __construct()
    {
        $this->path = storage_path() . "/local/ordini.csv";
        $this->load();

    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');

            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $ordine = OrdineFactory::create([
                        'id' => Arr::get($data, 0),
                        'data' => new \DateTime(Arr::get($data, 1)),
                        'totale' => Arr::get($data, 2),
                        'cliente_id' => Arr::get($data, 3),
                    ]);

                    $this->items[] = $ordine;
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

        /** @var Ordine $ordine */
        foreach ($this->items as $ordine) {
            if ($ordine instanceof Ordine) {
                fputcsv($file, [
                    $ordine->id,
                    $ordine->data->format('d-m-Y H:i:s'),
                    $ordine->totale,
                    $ordine->cliente_id
                ]);
            }
        }

        fclose($file);
    }
}
