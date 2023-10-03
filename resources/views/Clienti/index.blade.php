@extends('layout')

@section('title')
    Lista di Clienti
@endsection

@section('content')
    <div class="container">
        <form style="max-width: 480px" action="{{ route('clienti.index') }}">
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


                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <div class="d-flex gap-2 mb-5">
            <h2>Lista di Clienti</h2>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('clienti.create') }}">Nuovo</a>
        </div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Ordini</th>
            </tr>
            @foreach($clienti as $key => $cliente)
                <tr>
                    <td>{{$cliente->id}}</td>
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->cognome}}</td>
                    <td>{{$cliente->email}}</td>
                    <td>{{count($ordini[$key])}}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning d-flex align-items-center justify-content-center"
                           href="{{ route('clienti.edit', ['clienti' => $cliente->id]) }}">Edit</a>
                        <form method="POST" action="{{ route('clienti.destroy', ['clienti' => $cliente->id]) }}">
                            @method('delete')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <h4>Cliente con piu ordini</h4>
        <table style="max-width: 380px" class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Ordini</th>
            </tr>
            <tr>
                <td>{{ $piuOrdini[0]->id ?? '--' }}</td>
                <td>{{ $piuOrdini[0]->nome ?? '--' }}</td>
                <td>{{ count($piuOrdini[1]) ?? '--' }}</td>
            </tr>
        </table>
    </div>

    <div class="container">
        <a href="" class="link-success text-decoration-none fw-bold">
            <p>1. Tutti gli Ordini effettuati dopo una certa data</p></a>

        <a href="{{ route('clienti.index') }}?0orders=true" class="link-success text-decoration-none fw-bold">
            <p>2. Tutti i clienti che non hanno effettuato nessun ordine</p></a>

        <a href="{{ route('ordini.index') }}" class="link-success text-decoration-none fw-bold">
            <p>3. L'ordine con il totale piu alto</p></a>

        <p class="text-success">4. Aggiornare il totale di un ordine specifico</p>

        <a href="{{ route('ordini.groupRemove') }}" class="link-success text-decoration-none fw-bold">
            <p>5. Eliminare tutti gli ordini con un totale inferire a 10</p></a>

        <a href="{{ route('clienti.create') }}" class="link-success text-decoration-none fw-bold">
            <p>6. Inserire un nuovo cliente nel databases</p></a>

        <a href="{{ route('ordini.create') }}" class="link-success text-decoration-none fw-bold">
            <p>7. Inserire un nuovo ordine associato a un cliente</p></a>

        <a href="{{ route('clienti.index') }}" class="link-success text-decoration-none fw-bold">
            <p>8. Selezionare il cliente che ha effettuato il maggior numero di ordini</p></a>

        <a href="{{ route('ordini.index') }}" class="link-success text-decoration-none fw-bold">
            <p>9. Seleziona tutti gli ordini e i relativi clienti</p></a>

        <a href=" {{ route('clienti.index') }}" class="link-success text-decoration-none fw-bold">
            <p>10. Contare quanti ordini per ogni cliente sono presenti</p></a>
    </div>
@endsection
