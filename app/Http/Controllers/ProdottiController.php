<?php

namespace App\Http\Controllers;

use App\Factory\FornitoreFactory;
use App\Factory\ProdottoFactory;
use App\Management\ProdottiManagement;
use App\Repository\FornitoriRepository;
use App\Repository\ProdottiRepository;
use Illuminate\Http\Request;

class ProdottiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProdottiManagement $management, FornitoriRepository $fornitoriRepository, Request $request)
    {
        $prodotti = $request['fornitore'] ? $management->search($request['fornitore']) : null;
        $prodotti = $request['search'] ? $management->search($request['search'], $prodotti) : $prodotti;
        $prodotti = $management->filter($request['by'] ?? 'prezzo', $request['min'] ?? 0, $request['max'] ?? INF, $prodotti);
        $prodotti = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $prodotti);
        $fornitori = $fornitoriRepository->getAll();

        return view('prodotti.index', ['prodotti' => $prodotti, 'fornitori' => $fornitori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ProdottiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'fornitore' => 'required',
            'quantita' => 'required',
            'prezzo' => 'required',
        ]);

        $prodotto = ProdottoFactory::create([
            'nome' => $validate['nome'],
            'fornitore_id' => $validate['fornitore'],
            'quantita' => $validate['quantita'],
            'prezzo' => $validate['prezzo'],
        ]);

        if (!$repository->insert($prodotto)) {
            return redirect()->route('prodotti.create');
        }

        return redirect()->route('prodotti.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FornitoriRepository $fornitoriRepository)
    {
        $fornitori = $fornitoriRepository->getAll();
        return view('prodotti.create', ['fornitori' => $fornitori]);
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
    public function edit(string $id, ProdottiRepository $repository, FornitoriRepository $fornitoriRepository)
    {
        $prodotto = $repository->find($id);
        $fornitori = $fornitoriRepository->getAll();

        return view('prodotti.edit', ['prodotto' => $prodotto, 'fornitori' => $fornitori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ProdottiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'fornitore' => 'required',
            'quantita' => 'required',
            'prezzo' => 'required',
        ]);

        $prodotto = ProdottoFactory::create([
            'id' => $id,
            'nome' => $validate['nome'],
            'fornitore_id' => $validate['fornitore'],
            'quantita' => $validate['quantita'],
            'prezzo' => $validate['prezzo'],
        ]);

        $repository->update($prodotto);

        return redirect()->route('prodotti.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ProdottiRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('prodotti.index');
    }

    public function destroyVoid(ProdottiManagement $management)
    {
        $management->removeGroup('quantita');
        return redirect()->route('prodotti.index');
    }
}
