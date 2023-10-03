@extends('layout')
@section('title')
    Aggiungere un fornitore
@endsection
@section('content')
    <div class="container mt-5">
        <h2>Nuovo Fornitore</h2>
        <form class="mt-5" method="POST" action="{{ route('fornitori.store') }}">
            @csrf
            <label for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="nome">

            <label for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email">

            <label for="tel">Telefono</label>
            <input class="form-control" id="tel" type="tel" name="telefono">

            <button type="submit" class="btn btn-primary mt-3">Creare</button>
        </form>
    </div>
@endsection
