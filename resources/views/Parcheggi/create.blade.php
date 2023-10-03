@extends('layout')
@section('title')
    Aggiungere un Parcheggio
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo Parcheggio</h2>
        <form class="mt-5" method="POST" action="{{ route('parcheggi.store') }}">
            @csrf
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome">

            <label for="indirizzo">Indirizzo</label>
            <input class="form-control" id="indirizzo" type="text" name="indirizzo">

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
