@extends('layout')

@section('title')
    Lista di fornitori
@endsection

@section('content')
    <div class="container">
        <form style="max-width: 480px" action="{{ route('fornitori.index') }}">
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
                        <label for="order" class="input-group-text">Order By</label>
                        <select class="form-select" name="order" id="order">
                            <option value="nome" @if(request('order') == 'nome') selected @endif>Nome</option>
                            <option value="id" @if(request('order') == 'id') selected @endif>Id</option>
                            <option value="email" @if(request('order') == 'email') selected @endif>Email</option>
                            <option value="telefono" @if(request('order') == 'telefono') selected @endif>
                                Telefono
                            </option>
                        </select>

                        <select class="form-select" name='desc'>
                            <option value="">Asc</option>
                            <option value="true" @if(request('desc') == 'true') selected @endif>Desc</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-5">

        <div class="d-flex gap-2 mb-5">
            <h2>Lista di fornitori</h2>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('fornitori.create') }}">Nuovo</a>
        </div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Prodotti</th>
            </tr>
            @foreach($fornitori as $key => $fornitore)
                <tr>
                    <td>{{$fornitore->id}}</td>
                    <td>{{$fornitore->nome}}</td>
                    <td>{{$fornitore->email}}</td>
                    <td>{{$fornitore->telefono}}</td>
                    <td>{{count($prodotti[$key])}}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning d-flex align-items-center justify-content-center"
                           href="{{ route('fornitori.edit', ['fornitori' => $fornitore->id]) }}">Edit</a>
                        <form method="POST" action="{{ route('fornitori.destroy', ['fornitori' => $fornitore->id]) }}">
                            @method('delete')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <h4>Fornitore con il prodotto piu costoso</h4>
        <table style="max-width: 380px" class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Nome Prodotto</th>
                <th>Prezzo</th>
            </tr>
            <tr>
                <td>{{ $piuCostoso[0]->id ?? '--' }}</td>
                <td>{{ $piuCostoso[0]->nome ?? '--' }}</td>
                <td>{{ $piuCostoso[1]->nome ?? '--' }}</td>
                <td>${{ $piuCostoso[1]->prezzo ?? '--' }}</td>
            </tr>
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
