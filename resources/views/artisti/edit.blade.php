@extends('layout')
@section('title')
    Editare {{ $artista->nome }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare artista {{ $artista->nome }}</h2>
        <form class="mt-5" method="POST" action="{{ route('artisti.update', ['artisti' => $artista->id]) }}">
            @csrf
            @method('PUT')
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome" value="{{ $artista->nome }}">

            <label for="data">Anno di nascita</label>
            <input class="form-control" type="number" id="data" name="anno_nascita" value="{{ $artista->anno_nascita }}">

            <label for="nazione">Nazione</label>
            <input class="form-control" id="nazione" type="text" name="nazione" value="{{ $artista->nazione }}">

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
