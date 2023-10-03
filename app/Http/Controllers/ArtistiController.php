<?php

namespace App\Http\Controllers;

use App\Factory\ArtistaFactory;
use App\Management\ArtistiManagement;
use App\Repository\ArtistiRepository;
use Illuminate\Http\Request;

class ArtistiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArtistiManagement $management, Request $request)
    {
        $artisti = $request['search'] ? $management->search($request['search']) : null;
        $artisti = $management->orderBy($request['order'] ?? 'id', !is_string($request['desc']), $artisti);
        $quadri = [];
        $piuQuadri = [];

        foreach ($artisti as $key => $artista) {
            $quadri[$key] = $management->hasMany($artista->id, 'artista_id');
            if (count($quadri[$key]) > (count($piuQuadri[1] ?? [])) ) {
                $piuQuadri = [$artista, $quadri[$key]];
            }
        }

        return view('artisti.index', ['artisti' => $artisti, 'quadri' => $quadri, 'piuQuadri' => $piuQuadri]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ArtistiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'anno_nascita' => 'required',
            'nazione' => 'required',
        ]);

        $artisti = ArtistaFactory::create([
            'nome' => $validate['nome'],
            'anno_nascita' => $validate['anno_nascita'],
            'nazione' => $validate['nazione'],
        ]);

        if (!$repository->insert($artisti)) {
            return redirect()->route('artisti.create');
        }

        return redirect()->route('artisti.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artisti.create');
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
    public function edit(string $id, ArtistiRepository $repository)
    {
        $artista = $repository->find($id);

        return view('artisti.edit', ['artista' => $artista]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ArtistiRepository $repository)
    {
        $validate = $request->validate([
            'nome' => 'required',
            'anno_nascita' => 'required',
            'nazione' => 'required',
        ]);

        $artista = ArtistaFactory::create([
            'id' => $id,
            'nome' => $validate['nome'],
            'anno_nascita' => $validate['anno_nascita'],
            'nazione' => $validate['nazione'],
        ]);

        $repository->update($artista);

        return redirect()->route('artisti.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ArtistiRepository $repository)
    {
        $repository->delete($id);
        return redirect()->route('artisti.index');
    }
}
