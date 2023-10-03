@extends('layout')

@section('title')
    Lista di parcheggi
@endsection

@section('content')
    <div class="container">
        <form style="max-width: 480px" action="{{ route('parcheggi.index') }}">
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
                            <option value="cognome" @if(request('order') == 'cognome') selected @endif>Cognome</option>
                            <option value="id" @if(request('order') == 'id') selected @endif>Id</option>
                            <option value="email" @if(request('order') == 'email') selected @endif>Email</option>
                        </select>

                        <select class="form-select" name='desc'>
                            <option value="">Asc</option>
                            <option value="true" @if(request('desc') == 'true') selected @endif>Desc</option>
                        </select>
                    </div>

                    <div class="input-group mt-2">
                        <label for="marca" class="input-group-text">Marca</label>
                        <select class="form-select" name="marca" id="marca">
                            <option value="">All</option>
                            @foreach($marche as $marca)
                                <option value="{{ $marca }}" @if(request('marca') == $marca) selected @endif>{{ $marca }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">

        <div class="d-flex gap-2 mb-5">
            <h2>Lista di parcheggi</h2>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('parcheggi.create') }}">Nuovo</a>
        </div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Indirizzo</th>
                <th>Veicoli</th>
            </tr>
            @foreach($parcheggi as $key => $parcheggio)
                <tr>
                    <td>{{$parcheggio->id}}</td>
                    <td>{{$parcheggio->nome}}</td>
                    <td>{{$parcheggio->indirizzo}}</td>
                    <td>{{ count($veicoli[$key]) }}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning d-flex align-items-center justify-content-center"
                           href="{{ route('parcheggi.edit', ['parcheggi' => $parcheggio->id]) }}">Edit</a>
                        <form method="POST" action="{{ route('parcheggi.destroy', ['parcheggi' => $parcheggio->id]) }}">
                            @method('delete')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>


        <h4>Parcheggio con piu auto</h4>
        <table style="max-width: 380px" class="table">
            <tr>
                <th>Nome</th>
                <th>indirizzo</th>
                <th>Veicoli</th>
            </tr>
            <tr>
                <td>{{ $piuVeicoli[0]->nome ?? '--' }}</td>
                <td>{{ $piuVeicoli[0]->indirizzo ?? '--' }}</td>
                <td>{{ count($piuVeicoli[1] ?? []) }}</td>
            </tr>
        </table>
    </div>

    <div class="container">
        <a href="{{ route('veicoli.index') }}?parcheggio={{ $parcheggio->id ?? ''}}" class="link-success text-decoration-none fw-bold">
            <p>1. Selezionare tutti i veicoli parcheggiati in un determinato parcheggio</p></a>

        <a href="{{ route('parcheggi.index') }}?marca={{ $marca ?? '' }}" class="link-success text-decoration-none fw-bold">
            <p>2. Selezionare tutti i parcheggi in cui e parcheggiata una determinata marca</p></a>

        <a href="{{ route('veicoli.create') }}" class="link-success text-decoration-none fw-bold">
            <p>3. Inserire un nuovo veicolo nel databases</p></a>

        <a href="{{ route('parcheggi.create') }}" class="link-success text-decoration-none fw-bold">
            <p>4. Inserire un nuovo parcheggio nel databases</p></a>

        <a href="{{ route('parcheggi.index') }}" class="link-warning text-decoration-none fw-bold">
            <p>5. Aggiornare il parcheggio in cui e parcheggiato un determinato veicolo</p></a>

        <a href="{{ route('veicoli.index') }}" class="link-success text-decoration-none fw-bold">
            <p>6. Eliminare un veicolo dal databases</p></a>

        <a href="{{ route('parcheggi.index') }}" class="link-success text-decoration-none fw-bold">
            <p>7. Eliminare un parcheggio dal databases</p></a>

        <a href="{{ route('parcheggi.index') }}" class="link-success text-decoration-none fw-bold">
            <p>8. Contare Quanti veicolo sono parcheggiati in ogni parcheggio</p></a>

        <a href="{{ route('parcheggi.index') }}" class="link-success text-decoration-none fw-bold">
            <p>9. Seleziona il parcheggio che ospita il maggior numero di veicoli</p></a>

        <a href="{{ route('veicoli.index') }}?modello={{ $modello ?? ''}}" class="link-success text-decoration-none fw-bold">
            <p>10. Selezionare tutti i veicolo di una determinata marca e modello</p></a>
    </div>
@endsection
