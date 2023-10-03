@extends('layout')
@section('title')
    Editare {{ $prodotto->nome }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare prodotto {{ $prodotto->nome }}</h2>
        <form class="mt-5" method="POST" action="{{ route('prodotti.update', ['prodotti' => $prodotto->id]) }}">
            @csrf
            @method('PUT')
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome" value="{{ $prodotto->nome }}">

            <label for="fornitore">Fornitore</label>
            <select class="form-select" name="fornitore" id="fornitore">
                @foreach($fornitori as $fornitore)
                    <option value="{{ $fornitore->id }}" {{ ($fornitore->id === $prodotto->fornitore_id) ? 'selected ' : ''}}>{{ $fornitore->nome }}</option>
                @endforeach
            </select>

            <label for="quantita">Quantita</label>
            <input class="form-control" id="quantita" type="number" name="quantita" value="{{ $prodotto->quantita }}">

            <label for="prezzo">Prezzo</label>
            <input class="form-control" id="prezzo" type="number" name="prezzo" value="{{ $prodotto->prezzo }}">

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
