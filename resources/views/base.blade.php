<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') - Jardim Floricultura</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ request()->url() }}">Jardim Floricultura</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('categorias.index') }}">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('flores.index') }}">Flores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pedidos.index') }}">Pedidos</a></li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="row">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Por favor, verifique os erros abaixo:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            @yield('conteudo')
        </div>
    </div>
    <footer class="bg-success text-white text-center py-3 fixed-bottom">
        <div class="container">
            <p class="mb-0">Desenvolvido por Lucimar e Gabriel</p>
        </div>
    </footer>
</body>
</html>
