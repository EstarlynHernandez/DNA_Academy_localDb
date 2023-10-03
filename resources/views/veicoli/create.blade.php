@extends('layout')
@section('title')
    Aggiungere un Veicolo
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo Veicolo</h2>
        <form class="mt-5" method="POST" action="{{ route('veicoli.store') }}">
            @csrf
            <label for="targa">Targa</label>
            <input class="form-control" type="text" id="targa" name="targa">

            <label for="marca">Marca</label>
            <input class="form-control" type="text" id="marca" name="marca">

            <label for="parcheggio">Veicolo</label>
            <select class="form-control" id="parcheggio" name="parcheggio">
                @foreach($parcheggi as $parcheggio)
                    <option value="{{ $parcheggio->id }}">{{ $parcheggio->nome }}</option>
                @endforeach
            </select>


            <label for="modello">Modello</label>
            <input class="form-control" id="modello" type="text" name="modello">

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
