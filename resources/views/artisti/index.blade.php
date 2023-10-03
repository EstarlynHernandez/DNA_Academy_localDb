@extends('layout')

@section('title')
    Lista di artisti
@endsection

@section('content')
    <div class="container">
        <form style="max-width: 480px" action="{{ route('artisti.index') }}">
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
            <h2>Lista di artisti</h2>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('artisti.create') }}">Nuovo</a>
        </div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Data di nascita</th>
                <th>Nazione</th>
                <th>N. di quadri</th>
            </tr>
            @foreach($artisti as $key => $artista)
                <tr>
                    <td>{{$artista->id}}</td>
                    <td>{{$artista->nome}}</td>
                    <td>{{$artista->anno_nascita}}</td>
                    <td>{{$artista->nazione}}</td>
                    <td>{{count($quadri[$key])}}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning d-flex align-items-center justify-content-center"
                           href="{{ route('artisti.edit', ['artisti' => $artista->id]) }}">Edit</a>
                        <form method="POST" action="{{ route('artisti.destroy', ['artisti' => $artista->id]) }}">
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
                <th>Nome</th>
                <th>Nascita</th>
                <th>Quadri</th>
            </tr>
            <tr>
                <td>{{ $piuQuadri[0]->nome ?? '--' }}</td>
                <td>{{ $piuQuadri[0]->anno_nascita ?? '--' }}</td>
                <td>{{ count($piuQuadri[1]) ?? '--' }}</td>
            </tr>
        </table>
    </div>

    <div class="container">
        <a href="{{ route('quadri.index') }}?from=1900" class="link-success text-decoration-none fw-bold">
            <p>1. Selezionare tutti i quadri dopo il 1900</p></a>

        <a href="{{ route('artisti.index') }}?search=italia" class="link-success text-decoration-none fw-bold">
            <p>2. Selezionare tutti gli artisti Italiani</p></a>

        <a href="" class="link-success text-decoration-none fw-bold">
            <p>3. Inserire un nuovo artista nel databases</p></a>

        <a href="" class="link-success text-decoration-none fw-bold">
            <p>4. Inserire un nuovo quadro associato a un artista nel databases</p></a>

        <a href="" class="link-success text-decoration-none fw-bold">
            <p>5. Aggiornare l'anno di un determinato quadro</p></a>

        <a href="" class="link-success text-decoration-none fw-bold">
            <p>6. Eliminare un artista dal databases</p></a>

        <a href="" class="link-success text-decoration-none fw-bold">
            <p>7. Eliminare un quadro dal databases</p></a>

        <a href="{{ route('artisti.index') }}" class="link-success text-decoration-none fw-bold">
            <p>8. Contare Quanti quadri ha realizzato ogni artista</p></a>

        <a href="{{ route('artisti.index') }}" class="link-success text-decoration-none fw-bold">
            <p>9. Seleziona l'artista che ha creato il maggior numero di quadri</p></a>

        <a href="{{ route('quadri.index') }}" class="link-success text-decoration-none fw-bold">
            <p>10. Selezionare tutti gli artisti e i loro quadri</p></a>
    </div>
@endsection
