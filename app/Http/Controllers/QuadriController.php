<?php

namespace App\Http\Controllers;

use App\Factory\QuadroFactory;
use App\Management\ParcheggiManagement;
use App\Management\QuadriManagement;
use App\Repository\ArtistiRepository;
use App\Repository\ParcheggiRepository;
use App\Repository\QuadriRepository;
use Illuminate\Http\Request;

class QuadriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, QuadriManagement $management)
    {
        $quadri = $request['search'] ? $management->search($request['search']) : null;
        $quadri = $management->filter($request['by'] ?? 'anno', $request['min'] ?? 0, $request['max'] ?? INF, $quadri);
        $quadri = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $quadri);
        $quadri = $management->filter('anno', $request['from'] ?? 0, $request['to'] ?? 3000, $quadri);

        foreach ($quadri as $key => $quadro) {
            $artisti[$key] = $management->findForeignKey($quadro->id, 'artista_id');
        }

        return view('quadri.index', ['quadri' => $quadri, 'artisti' => $artisti ?? null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, QuadriRepository $repository)
    {
        $validate = $request->validate([
            'titolo' => 'required',
            'anno' => 'required',
            'artista' => 'required'
        ]);

        $quadro = QuadroFactory::create([
            'titolo' => $validate['titolo'],
            'anno' => $validate['anno'],
            'artista_id' => $validate['artista'],
        ]);

        if (!$repository->insert($quadro)) {
            return redirect()->route('quadri.create');
        }

        return redirect()->route('quadri.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ArtistiRepository $artistaRepository)
    {
        $artisti = $artistaRepository->getAll();
        return view('quadri.create', ['artisti' => $artisti]);
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
    public function edit(string $id, QuadriRepository $repository, ArtistiRepository $artistiRepository)
    {
        $quadro = $repository->find($id);
        $artisti = $artistiRepository->getAll();

        return view('quadri.edit', ['quadro' => $quadro, 'artisti' => $artisti]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, QuadriRepository $repository)
    {
        $validate = $request->validate([
            'titolo' => 'required',
            'anno' => 'required',
            'artista' => 'required'
        ]);

        $ordine = QuadroFactory::create([
            'id' => $id,
            'titolo' => $validate['titolo'],
            'anno' => $validate['anno'],
            'artista_id' => $validate['artista'],
        ]);

        $repository->update($ordine);

        return redirect()->route('quadri.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, QuadriRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('quadri.index');
    }
}
