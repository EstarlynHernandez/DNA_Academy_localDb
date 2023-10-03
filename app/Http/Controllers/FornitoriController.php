<?php

namespace App\Http\Controllers;

use App\Management\FornitoriManagement;
use App\Management\ProdottiManagement;
use App\Repository\FornitoriRepository;
use Illuminate\Http\Request;
use App\Factory\FornitoreFactory;

class FornitoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FornitoriManagement $management, ProdottiManagement $prodottiManagement, Request $request)
    {
        $fornitori = $request['search'] ? $management->search($request['search']) : null;
        $fornitori = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $fornitori);
        $prodotti = [];

        foreach ($fornitori as $key => $fornitore) {
            $prodotti[$key] = $management->hasMany($fornitore->id, 'fornitore_id');
        }

        $prodotti = [];
        $piuCostoso = [];

        foreach ($fornitori as $key => $fornitore) {
            $prodotti[$key] = $management->hasMany($fornitore->id, 'fornitore_id');
            foreach ($prodotti[$key] as $prodotto) {
                if ($prodotto->prezzo > ($piuCostoso[1]->prezzo ?? 0)) {
                    $piuCostoso = [$fornitore, $prodotto];
                }
            }
        }

        return view('fornitori.index', ['fornitori' => $fornitori, 'prodotti' => $prodotti, 'piuCostoso' => $piuCostoso]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FornitoriRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefono' => 'required|string',
        ]);

        $fornitore = FornitoreFactory::create([
            'nome' => $validate['nome'],
            'email' => $validate['email'],
            'telefono' => $validate['telefono'],
        ]);

        if (!$repository->insert($fornitore)) {
            return redirect()->route('fornitori.create');
        }

        return redirect()->route('fornitori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fornitori.create');
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
    public function edit(string $id, FornitoriRepository $repository)
    {
        $fornitore = $repository->find($id);

        return view('fornitori.edit', ['fornitore' => $fornitore]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, FornitoriRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefono' => 'required|string',
        ]);

        $fornitore = FornitoreFactory::create([
            'id' => $id,
            'nome' => $validate['nome'],
            'email' => $validate['email'],
            'telefono' => $validate['telefono'],
        ]);

        $repository->update($fornitore);

        return redirect()->route('fornitori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FornitoriRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('fornitori.index');
    }
}
