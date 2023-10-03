<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('prodotti.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'prodotti')) active @endif">Prodotti</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clienti.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'clienti')) active @endif">Clienti</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('fornitori.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'fornitori')) active @endif">Fornitori</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ordini.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'ordini')) active @endif">Ordini</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('artisti.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'artisti')) active @endif">Artisti</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('veicoli.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'veicoli')) active @endif">Veicoli</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parcheggi.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'parcheggi')) active @endif">Parcheggi</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('quadri.index') }}"
                       class="nav-link @if(Str::contains(URL::current(), 'quadri')) active @endif">Quadri</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
@yield('content')
</body>
</html>
