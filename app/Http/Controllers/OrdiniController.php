<?php

namespace App\Http\Controllers;

use App\Factory\OrdineFactory;
use App\Management\OrdiniManagement;
use App\Repository\ClientiRepository;
use App\Repository\OrdiniRepository;
use Illuminate\Http\Request;

class OrdiniController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(OrdiniManagement $management, Request $request)
    {
        $ordini = $request['search'] ? $management->search($request['search']) : null;
        $ordini = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $ordini);
        $ordini = $management->filter('data', new \DateTime($request['from'] ?? '0-0-0'), new \DateTime($request['to'] ?? 'now'), $ordini);
        $clienti = [];
        $ordinePiuAlto = null;

        foreach ($ordini as $key => $ordine) {
            $clienti[$key] = $management->findForeignKey($ordine->id, 'cliente_id');

            if ($ordine->totale > ($ordinePiuAlto->totale ?? 0)) {
                $ordinePiuAlto = $ordine;
            }
        }

        return view('ordini.index', ['ordini' => $ordini, 'clienti' => $clienti, 'ordinePiuAlto' => $ordinePiuAlto]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, OrdiniRepository $repository)
    {
        $validate = $request->validate([
            'totale' => 'required',
            'cliente' => 'required'
        ]);

        $ordine = OrdineFactory::create([
            'cliente_id' => $validate['cliente'],
            'totale' => $validate['totale'],
        ]);

        if (!$repository->insert($ordine)) {
            return redirect()->route('ordini.create');
        }

        return redirect()->route('ordini.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ClientiRepository $clientiRepository)
    {
        $clienti = $clientiRepository->getAll();
        return view('ordini.create', ['clienti' => $clienti]);
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
    public function edit(string $id, OrdiniRepository $repository, ClientiRepository $clientiRepository)
    {
        $ordine = $repository->find($id);
        $clienti = $clientiRepository->getAll();

        return view('ordini.edit', ['ordine' => $ordine, 'clienti' => $clienti]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, OrdiniRepository $repository)
    {
        $validate = $request->validate([
            'totale' => 'required',
            'cliente' => 'required',
        ]);

        $ordine = OrdineFactory::create([
            'id' => $id,
            'totale' => $validate['totale'],
            'cliente_id' => $validate['cliente']
        ]);

        $repository->update($ordine);

        return redirect()->route('ordini.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, OrdiniRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('ordini.index');
    }

    public function destroyVoid(OrdiniManagement $management)
    {
        $management->removeGroup('totale', 10);
        return redirect()->route('ordini.index');
    }
}
