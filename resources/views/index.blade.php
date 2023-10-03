@extends('layout')
@section('title')
    Home
@endsection

@section('content')
    <h1 class="container mt-2">Lista di esercizi</h1>
    <div class="container mt-5">
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Prodotti</h3></a>
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Fornitori</h3></a>
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Clienti</h3></a>
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Ordini</h3></a>
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Veicolo</h3></a>
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Parcheggi</h3></a>
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Artisti</h3></a>
        <a class="text-decoration-none" href="{{ route('prodotti.index')}}"><h3 style="max-width: 240px" class="text-bg-secondary p-3 mb-3 rounded">Quadri</h3></a>
    </div>
@endsection
