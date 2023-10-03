@extends('layout')
@section('title')
    Aggiungere un Cliente
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo cliente</h2>
        <form class="mt-5" method="POST" action="{{ route('clienti.store') }}">
            @csrf
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome">

            <label for="cognome">Cognome</label>
            <input class="form-control" id="cognome" type="text" name="cognome">

            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email">

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
