@extends('layout')
@section('title')
    Aggiungere un Prodotto
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo Prodotto</h2>
        <form class="mt-5" method="POST" action="{{ route('prodotti.store') }}">
            @csrf
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome">

            <label for="fornitore">Fornitore</label>
            <select class="form-select" name="fornitore" id="fornitore">
                @foreach($fornitori as $fornitore)
                    <option value="{{ $fornitore->id }}">{{ $fornitore->nome }}</option>
                @endforeach
            </select>

            <label for="quantita">Quantita</label>
            <input class="form-control" id="quantita" type="number" name="quantita">

            <label for="prezzo">Prezzo</label>
            <input class="form-control" id="prezzo" type="number" name="prezzo">

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
