@extends('layout')
@section('title')
    Editare {{ $cliente->nome }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare cliente {{ $cliente->nome }}</h2>
        <form class="mt-5" method="POST" action="{{ route('clienti.update', ['clienti' => $cliente->id]) }}">
            @csrf
            @method('PUT')
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome" value="{{ $cliente->nome }}">

            <label for="cognome">Cognome</label>
            <input class="form-control" id="cognome" type="text" name="cognome" value="{{ $cliente->cognome }}">

            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" value="{{ $cliente->email }}">

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
