@extends('layout')

@section('title')
    Lista di Quadri
@endsection

@section('content')
    <div class="container">
        <form style="max-width: 480px" action="{{ route('quadri.index') }}">
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
                            <option value="id" @if(request('order') == 'id') selected @endif>Id</option>
                            <option value="titolo" @if(request('order') == 'titolo') selected @endif>Titolo</option>
                            <option value="anno" @if(request('order') == 'anno') selected @endif>Anno</option>
                        </select>

                        <select class="form-select" name='desc'>
                            <option value="">Asc</option>
                            <option value="true" @if(request('desc') == 'true') selected @endif>Desc</option>
                        </select>
                    </div>

                    <div class="input-group mt-2">
                        <label for="from" class="input-group-text">Per Data</label>
                        <label for="from" class="input-group-text">From</label>
                        <input name="from" class="form-control" type="number" id="from" value="{{ request('from') }}">

                        <label for="to" class="input-group-text">To</label>
                        <input name="to" class="form-control" type="number" id="to" value="{{ request('to') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <div class="d-flex gap-2 mb-5">
            <h2>Lista di Quadri</h2>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('quadri.create') }}">Nuovo</a>
        </div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Titolo</th>
                <th>Anno</th>
                <th>Artista</th>
            </tr>
            @foreach($quadri as $key => $quadro)
                <tr>
                    <td>{{$quadro->id}}</td>
                    <td>{{$quadro->titolo}}</td>
                    <td>{{$quadro->anno}}</td>
                    <td>{{$artisti[$key]->nome}}</td>
                    <td class="d-flex gap-1">
                        <a class="btn btn-warning d-flex align-items-center justify-content-center"
                           href="{{ route('quadri.edit', ['quadri' => $quadro->id]) }}">Edit</a>
                        <form method="POST" action="{{ route('quadri.destroy', ['quadri' => $quadro->id]) }}">
                            @method('delete')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
