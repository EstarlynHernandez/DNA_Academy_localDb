@extends('layout')
@section('title')
    Editare {{ $parcheggio->nome }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare Parcheggio {{ $parcheggio->nome }}</h2>
        <form class="mt-5" method="POST" action="{{ route('parcheggi.update', ['parcheggi' => $parcheggio->id]) }}">
            @csrf
            @method('PUT')
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome" value="{{ $parcheggio->nome }}">

            <label for="indirizzo">Indirizzo</label>
            <input class="form-control" id="indirizzo" type="text" name="indirizzo" value="{{ $parcheggio->indirizzo }}">

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
