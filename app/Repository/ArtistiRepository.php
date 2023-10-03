<?php

namespace App\Repository;

use App\Factory\ArtistaFactory;
use App\LocalModels\Artista;
use Illuminate\Support\Arr;

class ArtistiRepository extends Repository
{

    protected array $items = [];
    private string $path;

    public function __construct()
    {
        $this->path = storage_path() . "/local/artisti.csv";
        $this->load();

    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');

            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $artista = ArtistaFactory::create([
                        'id' => Arr::get($data, 0),
                        'nome' => Arr::get($data, 1),
                        'anno_nascita' => Arr::get($data, 2),
                        'nazione' => Arr::get($data, 3),
                    ]);

                    $this->items[] = $artista;
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

        /** @var Artista $artista */
        foreach ($this->items as $artista) {
            if ($artista instanceof Artista) {
                fputcsv($file, [
                    $artista->id,
                    $artista->nome,
                    $artista->anno_nascita,
                    $artista->nazione
                ]);
            }
        }

        fclose($file);
    }
}
