@extends('layout')

@section('title')
    Lista di ordini
@endsection

@section('content')
    <div class="container">
        <form style="max-width: 480px" action="{{ route('ordini.index') }}">
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
                            <option value="data" @if(request('order') == 'data') selected @endif>Data</option>
                            <option value="totale" @if(request('order') == 'totale') selected @endif>Totale</option>
                        </select>

                        <select class="form-select" name='desc'>
                            <option value="">Asc</option>
                            <option value="true" @if(request('desc') == 'true') selected @endif>Desc</option>
                        </select>
                    </div>

                    <div class="input-group mt-2">
                        <label for="from" class="input-group-text">From</label>
                        <input class="form-control" value="{{ request('from') }}" type="date" name="from" id="from">

                        <label for="to" class="input-group-text">To</label>
                        <input class="form-control" type="date" value="{{ request('to') }}" name="to" id="to">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">

        <div class="d-flex gap-2 mb-5">
            <h2>Lista di ordini</h2>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('ordini.create') }}">Nuovo</a>
        </div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th>Totale</th>
                <th>Cliente</th>
                <th>Nome Cliente</th>
                <th>Email</th>
            </tr>
            @foreach($ordini as $key => $ordine)
                <tr>
                    <td>{{$ordine->id}}</td>
                    <td>{{$ordine->data->format('d/m/Y')}}</td>
                    <td>${{$ordine->totale}}</td>
                    <td>{{$ordine->cliente_id}}</td>
                    <td>{{$clienti[$key]->nome}}</td>
                    <td>{{$clienti[$key]->email}}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning d-flex align-items-center justify-content-center"
                           href="{{ route('ordini.edit', ['ordini' => $ordine->id]) }}">Edit</a>
                        <form method="POST" action="{{ route('ordini.destroy', ['ordini' => $ordine->id]) }}">
                            @method('delete')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <h4>Ordine piu alto</h4>
        <table style="max-width: 380px" class="table">
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th>Totale</th>
            </tr>
            <tr>
                <td>{{ $ordinePiuAlto->id ?? '--' }}</td>
                <td>{{ $ordinePiuAlto ? $ordinePiuAlto->data->format('d/m/Y') : '--' }}</td>
                <td>${{ $ordinePiuAlto->totale ?? '--' }}</td>
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
