@extends('layout')

@section('title')
    Lista di prodotti
@endsection

@section('content')

    <div class="container">
        <form style="max-width: 480px" action="{{ route('prodotti.index') }}">
            <div class="input-group mt-2">
                <label for="search" class="input-group-text">Search</label>
                <input id="search" class="form-control" type="text" name="search" placeholder="Search"
                       value="{{ request('search') }}">
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <button class="btn btn-outline-success" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                    Filters
                </button>

                <input class="btn btn-outline-primary" type="submit" value="Cerca">
            </div>

            <div class="collapse position-absolute" id="collapseExample">
                <div style="max-width: 480px" class="card card-body mt-2">
                    <h3>Filtri</h3>

                    <div class="input-group mt-2">
                        <label for="by" class="input-group-text">Filter By</label>
                        <select id="by" class="form-select" name="by">
                            <option value="prezzo" @if(request('by') == 'prezzo') selected @endif>Prezzo</option>
                            <option value="quantita" @if(request('by') == 'quantita') selected @endif>Quantita</option>
                        </select>

                        <label for="min" class="input-group-text">Min</label>
                        <input id="min" class="form-control" type="number" name="min" value="{{ request('min') }}">

                        <label for="max" class="input-group-text">Max</label>
                        <input id="max" class="form-control" type="number" name="max" value="{{ request('max') }}">
                    </div>

                    <div class="input-group mt-2">
                        <label for="order" class="input-group-text">Order By</label>
                        <select class="form-select" name="order" id="order">
                            <option value="prezzo" @if(request('order') == 'prezzo') selected @endif>Prezzo</option>
                            <option value="nome" @if(request('order') == 'nome') selected @endif>Nome</option>
                            <option value="id" @if(request('order') == 'id') selected @endif>Id</option>
                            <option value="quantita" @if(request('order') == 'quantita') selected @endif>Quantita
                            </option>
                            <option value="fornitore_id" @if(request('order') == 'fornitore_id') selected @endif>
                                Fornitore
                            </option>
                        </select>

                        <select class="form-select" name='desc'>
                            <option value="">Asc</option>
                            <option value="true" @if(request('desc') == 'true') selected @endif>Desc</option>
                        </select>

                        <label class="input-group-text" for="fornitore">Fornitore</label>
                        <select class="form-select" id="fornitore" name="fornitore">
                            <option value="">All</option>
                            @foreach($fornitori as $fornitore)
                                <option value="{{ $fornitore->id }}"
                                        @if(request('fornitore') == $fornitore->id) selected @endif>{{ $fornitore->nome }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <div class="d-flex gap-2 mb-5">
            <h2>Lista di prodotti</h2>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('prodotti.create') }}">Nuovo</a>
        </div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Quantita</th>
                <th>Prezzo</th>
                <th>Fornitore</th>
            </tr>
            @foreach($prodotti as $prodotto)
                <tr>
                    <td>{{ $prodotto->id }}</td>
                    <td>{{ $prodotto->nome }}</td>
                    <td>{{ $prodotto->quantita }}</td>
                    <td>${{ $prodotto->prezzo }}</td>
                    <td>{{ $prodotto->{'fornitore_id'} }}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning d-flex align-items-center justify-content-center"
                           href="{{ route('prodotti.edit', ['prodotti' => $prodotto->id]) }}">Edit</a>
                        <form method="POST" action="{{ route('prodotti.destroy', ['prodotti' => $prodotto->id]) }}">
                            @method('delete')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="container">
        <h3>Exercise</h3>
        <a href="{{ route('prodotti.index') }}?by=prezzo&min=50" class="link-success text-decoration-none fw-bold">
            <p>1. Tutti i prodotti con un prezzo superiore a 50</p></a>

        <a href="{{ route('fornitori.index') }}?search=%40example.com"
           class="link-success text-decoration-none fw-bold">
            <p>2. Tutti i fornitori che hanno un indirizzo email con 'example.com'</p></a>

        <a href="{{ route('prodotti.index') }}?fornitore={{ $prodotto->fornitore_id ?? 0 }}"
           class="link-success text-decoration-none fw-bold">
            <p>3. Tutti i prodotti da un determinato fornitore</p></a>

        <a href="{{ route('fornitori.index') }}" class="link-success text-decoration-none fw-bold">
            <p>4. Fornitore che offre il prodotto piu caro</p></a>

        <p class="text-success">5. Aggiorna il prezzo di un prodotto specifico</p>

        <a href="{{ route('prodotti.groupRemove') }}" class="link-success text-decoration-none fw-bold">
            <p>6. Eliminare tutti i prodotti con quantita 0</p></a>

        <a href="{{ route('fornitori.create') }}" class="link-success text-decoration-none fw-bold">
            <p>7. Inserisci un nuovo fornitore nel databases</p></a>

        <a href="{{ route('prodotti.create') }}" class="link-success text-decoration-none fw-bold">
            <p>8. Inserisci un nuovo prodotto associato a un fornitore</p></a>

        <a href="{{ route('prodotti.index') }}?order=prezzo&desc=true"
           class="link-success text-decoration-none fw-bold">
            <p>9. Tutti i prodotti ordinati per prezzo in modo discendente</p></a>

        <a href="{{ route('fornitori.index') }}" class="link-success text-decoration-none fw-bold">
            <p>10. Contare i prodotti associati a ogni fornitore</p></a>
    </div>
@endsection
