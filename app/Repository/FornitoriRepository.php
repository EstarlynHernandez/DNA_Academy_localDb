<?php

namespace App\Repository;

use App\Factory\FornitoreFactory;
use App\LocalModels\Fornitore;
use Illuminate\Support\Arr;

class FornitoriRepository extends Repository
{
    protected array $items = [];
    private string $path;

    public function __construct()
    {
        $this->path = storage_path() . "/local/fornitori.csv";
        $this->load();
    }

    protected function load(): void
    {
        if (file_exists($this->path)) {
            $file = fopen($this->path, 'r+');
            while (($data = fgetcsv($file)) != null) {
                if ($data[0]) {
                    $fornitore = FornitoreFactory::create([
                        'id' => Arr::get($data, 0),
                        'nome' => Arr::get($data, 1),
                        'telefono' => (int)Arr::get($data, 2),
                        'email' => Arr::get($data, 3),
                    ]);

                    $this->items[] = $fornitore;
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

        /** @var Fornitore $fornitore */
        foreach ($this->items as $fornitore) {
            if ($fornitore instanceof Fornitore) {
                fputcsv($file, [$fornitore->id, $fornitore->nome, $fornitore->telefono, $fornitore->email]);
            }
        }

        fclose($file);
    }
}
