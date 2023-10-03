<?php

namespace App\Repository;

use App\Factory\ProdottoFactory;
use App\LocalModels\Prodotto;
use Illuminate\Support\Arr;

class ProdottiRepository extends Repository
{
    protected array $items = [];
    private string $path;

    public function __construct()
    {
        $this->path = storage_path() . "/local/prodotti.csv";
        $this->load();

    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');

            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $prodotto = ProdottoFactory::create([
                        'id' => Arr::get($data, 0),
                        'nome' => Arr::get($data, 1),
                        'fornitore_id' => Arr::get($data, 2),
                        'quantita' => Arr::get($data, 3),
                        'prezzo' => Arr::get($data, 4),
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

        /** @var Prodotto $prodotto */
        foreach ($this->items as $prodotto) {
            if ($prodotto instanceof Prodotto) {
                fputcsv($file, [
                    $prodotto->id,
                    $prodotto->nome,
                    $prodotto->fornitore_id,
                    $prodotto->quantita,
                    $prodotto->prezzo
                ]);
            }
        }

        fclose($file);
    }
}
