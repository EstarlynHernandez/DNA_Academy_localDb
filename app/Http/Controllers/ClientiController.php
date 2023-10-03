<?php

namespace App\Http\Controllers;

use App\Factory\ClienteFactory;
use App\Management\ClientiManagement;
use App\Repository\ClientiRepository;
use Illuminate\Http\Request;

class ClientiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ClientiManagement $management, Request $request)
    {
        $clienti = $request['search'] ? $management->search($request['search']) : null;
        $clienti = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $clienti);
        $ordini = [];
        $piuOrdini = [];

        foreach ($clienti as $key => $cliente) {
            $ordini[$key] = $management->hasMany($cliente->id, 'cliente_id');
            if (count($ordini[$key]) > count($piuOrdini[1] ?? []) ) {
                $piuOrdini = [$cliente, $ordini[$key]];
            }

            if ($request['0orders'] && count($ordini[$key]) == 0) {
                $newClienti[] = $cliente;
                $newOrdini[] = [];
            }
        }

        $clienti = $newClienti ?? $clienti;
        $ordini = $newOrdini ?? $ordini;

        return view('clienti.index', ['clienti' => $clienti, 'ordini' => $ordini, 'piuOrdini' => $piuOrdini]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ClientiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
        ]);

        $fornitore = ClienteFactory::create([
            'nome' => $validate['nome'],
            'cognome' => $validate['cognome'],
            'email' => $validate['email'],
        ]);

        if (!$repository->insert($fornitore)) {
            return redirect()->route('clienti.create');
        }

        return redirect()->route('clienti.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clienti.create');
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
    public function edit(string $id, ClientiRepository $repository)
    {
        $cliente = $repository->find($id);

        return view('clienti.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ClientiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
        ]);

        $fornitore = ClienteFactory::create([
            'id' => $id,
            'nome' => $validate['nome'],
            'cognome' => $validate['cognome'],
            'email' => $validate['email'],
        ]);

        $repository->update($fornitore);

        return redirect()->route('clienti.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ClientiRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('clienti.index');
    }
}
