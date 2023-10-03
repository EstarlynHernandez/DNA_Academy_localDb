@extends('layout')
@section('title')
    Editare {{ $fornitore->nome }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare Fornitore</h2>
        <form class="mt-5" method="POST" action="{{ route('fornitori.update', ['fornitori' => $fornitore->id]) }}">
            @csrf
            @method('PUT')
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome" value="{{ $fornitore->nome }}">

            <label for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" value="{{ $fornitore->email }}">

            <label for="tel">Telefono</label>
            <input class="form-control" id="tel" type="tel" name="telefono" value="{{ $fornitore->telefono }}">

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
