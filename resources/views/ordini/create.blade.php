@extends('layout')
@section('title')
    Aggiungere un Ordine
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo Ordine</h2>
        <form class="mt-5" method="POST" action="{{ route('ordini.store') }}">
            @csrf
            <label for="totale">Totale</label>
            <input class="form-control" type="number" id="totale" name="totale">

            <label for="cliente">Cliente</label>
            <select name="cliente" id="cliente" class="form-select">
                @foreach($clienti as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
