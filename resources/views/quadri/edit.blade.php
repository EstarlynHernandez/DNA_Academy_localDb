@extends('layout')
@section('title')
    Editare {{ $quadro->titolo }}
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Editare Quadro {{ $quadro->titolo }}</h2>
        <form class="mt-5" method="POST" action="{{ route('quadri.update', ['quadri' => $quadro->id]) }}">
            @csrf
            @method('PUT')
            <label for="titolo">Titolo</label>
            <input class="form-control" type="text" id="titolo" name="titolo" value="{{ $quadro->titolo }}">

            <label for="artista">Artista</label>
            <select class="form-select" name="artista" id="artista">
                @foreach($artisti as $artista)
                    <option value="{{ $artista->id }}"
                    @if($artista->id == $quadro->artista_id) selected @endif>{{ $artista->nome }}</option>
                @endforeach
            </select>

            <label for="anno">Anno</label>
            <input class="form-control" id="anno" type="number" name="anno"
                   value="{{ $quadro->anno }}">

            <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        </form>
    </div>
@endsection
