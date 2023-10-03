@extends('layout')
@section('title')
    Editare {{ $ordine->id }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare ordine {{ $ordine->id }}</h2>
        <form class="mt-5" method="POST" action="{{ route('ordini.update', ['ordini' => $ordine->id]) }}">
            @csrf
            @method('PUT')
            <label for="totale">Totale</label>
            <input class="form-control" type="number" id="totale" name="totale" value="{{ $ordine->totale }}">

            <label for="cliente">Cliente</label>
            <select class="form-select" name="cliente" id="cliente">
                @foreach($clienti as $cliente)
                    <option value="{{ $cliente->id }}" @if($cliente->id == $ordine->id) selected @endif>{{ $cliente->nome }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
