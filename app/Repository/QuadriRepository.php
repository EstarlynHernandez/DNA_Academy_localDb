<?php

namespace App\Repository;

use App\Factory\QuadroFactory;
use App\LocalModels\Quadro;
use Illuminate\Support\Arr;

class QuadriRepository extends Repository
{

    private string $path;
    protected array $items = [];
    public function __construct()
    {
        $this->path = storage_path() . "/local/quadri.csv";
        $this->load();

    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');

            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $quadro = QuadroFactory::create([
                        'id' => Arr::get($data, 0),
                        'titolo' => Arr::get($data, 1),
                        'anno' => Arr::get($data, 2),
                        'artista_id' => Arr::get($data, 3),
                    ]);

                    $this->items[] = $quadro;
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

        /** @var Quadro $cliente */
        foreach ($this->items as $quadro) {
            if ($quadro instanceof Quadro) {
                fputcsv($file, [
                    $quadro->id,
                    $quadro->titolo,
                    $quadro->anno,
                    $quadro->artista_id
                ]);
            }
        }

        fclose($file);
    }
}
