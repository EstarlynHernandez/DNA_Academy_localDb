<?php

namespace App\Repository;
use App\Factory\ParcheggioFactory;
use App\LocalModels\Parcheggio;
use Illuminate\Support\Arr;

class ParcheggiRepository extends Repository
{

    private string $path;
    protected array $items = [];
    public function __construct()
    {
        $this->path = storage_path() . "/local/parcheggi.csv";
        $this->load();

    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');

            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $parcheggio = ParcheggioFactory::create([
                        'id' => Arr::get($data, 0),
                        'nome' => Arr::get($data, 1),
                        'indirizzo' => Arr::get($data, 2),
                    ]);

                    $this->items[] = $parcheggio;
                }
            }

            fclose($file);
        }

    }

    protected function save(): void
    {
        if (!file_exists($this->path)) {
            if (!file_exists(storage_path() . "/local")) {
                mkdir(storage_path() . "/local");
            }
            touch($this->path);
        }

        $file = fopen($this->path, 'w+');

        /** @var Parcheggio $parcheggio */
        foreach ($this->items as $parcheggio) {
            if ($parcheggio instanceof Parcheggio) {
                fputcsv($file, [
                    $parcheggio->id,
                    $parcheggio->nome,
                    $parcheggio->indirizzo,
                ]);
            }
        }

        fclose($file);
    }
}
