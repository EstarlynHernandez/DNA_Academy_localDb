<?php

namespace App\Http\Controllers;

use App\Factory\ParcheggioFactory;
use App\Management\ParcheggiManagement;
use App\Repository\ParcheggiRepository;
use App\Repository\VeicoliRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ParcheggiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ParcheggiManagement $management, Request $request, VeicoliRepository $veicoliRepository)
    {
        $parcheggi = $request['search'] ? $management->search($request['search']) : null;
        $parcheggi = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $parcheggi);
        $veicoli = [];
        $piuVeicoli = [];
        $marche = [];
        $allVeicoli = $veicoliRepository->getAll();

        foreach ($allVeicoli as $auto) {
            if (!in_array(strtolower($auto->marca), $marche)) {
                $marche[] = strtolower($auto->marca);
            }
        }

        foreach ($parcheggi as $key => $parcheggio) {
            $veicoli[$key] = $management->hasMany($parcheggio->id, 'parcheggio_id');

            if (count($veicoli[$key]) > (count($piuVeicoli[1] ?? []))) {
                $piuVeicoli = [$parcheggio, $veicoli[$key]];
            }

            if (count(array_filter($veicoli[$key], fn ($veicolo) => strtolower($veicolo->marca) == $request['marca'])) > 0) {
                $newParcheggi[$key] = $parcheggio;
            }
        }

        $parcheggi = $request['marca'] ? ($newParcheggi ?? []) : $parcheggi;

        return view('parcheggi.index', compact(['parcheggi', 'veicoli', 'piuVeicoli', 'marche']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ParcheggiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'indirizzo' => 'required'
        ]);

        $parcheggio = ParcheggioFactory::create([
            'nome' => $validate['nome'],
            'indirizzo' => $validate['indirizzo'],
        ]);

        if (!$repository->insert($parcheggio)) {
            return redirect()->route('parcheggi.create');
        }

        return redirect()->route('parcheggi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(VeicoliRepository $veicoliRepository)
    {
        $veicoli = $veicoliRepository->getAll();
        return view('parcheggi.create', ['veicoli' => $veicoli]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, ParcheggiRepository $repository, VeicoliRepository $veicoliRepository)
    {
        $parcheggio = $repository->find($id);
        $veicoli = $veicoliRepository->getAll();

        return view('parcheggi.edit', ['parcheggio' => $parcheggio, 'veicoli' => $veicoli]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ParcheggiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'indirizzo' => 'required',
            'veicolo' => 'required',
        ]);

        $ordine = ParcheggioFactory::create([
            'id' => $id,
            'nome' => $validate['nome'],
            'indirizzo' => $validate['indirizzo'],
            'veicolo_id' => $validate['veicolo']
        ]);

        $repository->update($ordine);

        return redirect()->route('parcheggi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ParcheggiRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('parcheggi.index');
    }
}
