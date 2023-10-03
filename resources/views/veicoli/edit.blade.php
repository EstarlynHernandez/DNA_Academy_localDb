@extends('layout')
@section('title')
    Editare {{ $veicolo->modello }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare Veicolo</h2>
        <form class="mt-5" method="POST" action="{{ route('veicoli.update', ['veicoli' => $veicolo->id]) }}">
            @csrf
            @method('PUT')
            <label for="targa">Targa</label>
            <input class="form-control" type="text" id="targa" name="targa" value="{{ $veicolo->targa }}">

            <label for="marca">Marca</label>
            <input class="form-control" type="text" id="marca" name="marca" value="{{ $veicolo->marca }}">

            <label for="parcheggio">Veicolo</label>
            <select class="form-control" id="parcheggio" name="parcheggio">
                @foreach($parcheggi as $parcheggio)
                    <option value="{{ $parcheggio->id }}" @if($parcheggio->id == $veicolo->parcheggio_id) Selected @endif>{{ $parcheggio->nome }}</option>
                @endforeach
            </select>

            <label for="modello">Modello</label>
            <input class="form-control" id="modello" type="text" name="modello" value="{{ $veicolo->modello }}">

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
