@extends('layout')
@section('title')
    Aggiungere un Quadro
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo Quadro</h2>
        <form class="mt-5" method="POST" action="{{ route('quadri.store') }}">
            @csrf
            <label for="titolo">Titolo</label>
            <input class="form-control" type="text" id="titolo" name="titolo">

            <label for="artista">Artista</label>
            <select class="form-select" name="artista" id="artista">
                @foreach($artisti as $artista)
                    <option value="{{ $artista->id }}">{{ $artista->nome }}</option>
                @endforeach
            </select>

            <label for="anno">Anno</label>
            <input class="form-control" id="anno" type="number" name="anno">

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
