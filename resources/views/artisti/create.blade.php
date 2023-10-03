@extends('layout')
@section('title')
    Aggiungere un Artista
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo Artista</h2>
        <form class="mt-5" method="POST" action="{{ route('artisti.store') }}">
            @csrf
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome">

            <label for="data">Anno di nascita</label>
            <input class="form-control" type="number" id="data" name="anno_nascita">

            <label for="nazione">Nazione</label>
            <input class="form-control" id="nazione" type="text" name="nazione">

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
