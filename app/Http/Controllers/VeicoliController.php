<?php

namespace App\Http\Controllers;

use App\Factory\VeicoloFactory;
use App\Management\VeicoliManagement;
use App\Repository\ParcheggiRepository;
use App\Repository\VeicoliRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class VeicoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VeicoliManagement $management, Request $request, ParcheggiRepository $parcheggiRepository)
    {
        $marche = [];
        $modelli = [];
        $allVeicoli = $management->orderBy('modello');
        $veicoli = $request['parcheggio'] ? $management->search($request['parcheggio']) : null;
        $veicoli = $request['search'] ? $management->search($request['search'], $veicoli) : $veicoli;
        $veicoli = $request['marca'] ? $management->search($request['marca'], $veicoli) : $veicoli;
        $veicoli = $request['modello'] ? $management->search($request['modello'], $veicoli) : $veicoli;
        $veicoli = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $veicoli);
        $parcheggi = $parcheggiRepository->getAll();


        foreach ($allVeicoli as $auto) {
            if (!in_array(strtolower($auto->marca), $marche)) {
                $marche[] = strtolower($auto->marca);
            }

            if (!in_array(strtolower($auto->modello), $modelli)) {
                $modelli[] = strtolower($auto->modello);
            }
        }
        return view('veicoli.index', compact(['veicoli', 'parcheggi', 'marche', 'modelli']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, VeicoliRepository $repository)
    {
        $validate = $request->validate([
            'targa' => 'required',
            'marca' => 'required',
            'modello' => 'required',
            'parcheggio' => 'required'
        ]);

        $veicolo = VeicoloFactory::create([
            'targa' => $validate['targa'],
            'marca' => $validate['marca'],
            'modello' => $validate['modello'],
            'parcheggio_id' => $validate['parcheggio'],
        ]);

        if (!$repository->insert($veicolo)) {
            return redirect()->route('veicoli.create');
        }

        return redirect()->route('veicoli.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ParcheggiRepository $parcheggioRepository)
    {
        $parcheggi = $parcheggioRepository->getAll();
        return view('veicoli.create', ['parcheggi' => $parcheggi]);
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
    public function edit(string $id, VeicoliRepository $repository, ParcheggiRepository $parcheggioRepository)
    {
        $veicolo = $repository->find($id);
        $parcheggi = $parcheggioRepository->getAll();

        return view('veicoli.edit', ['veicolo' => $veicolo, 'parcheggi' => $parcheggi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, VeicoliRepository $repository)
    {
        $validate = $request->validate([
            'targa' => 'required',
            'marca' => 'required',
            'modello' => 'required',
            'parcheggio' => 'required'
        ]);

        $veicolo = VeicoloFactory::create([
            'id' => $id,
            'targa' => $validate['targa'],
            'marca' => $validate['marca'],
            'modello' => $validate['modello'],
            'parcheggio_id' => $validate['parcheggio'],
        ]);

        $repository->update($veicolo);

        return redirect()->route('veicoli.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, VeicoliRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('veicoli.index');
    }
}
