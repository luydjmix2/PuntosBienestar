<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Puntos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Estilos para el menú superior */
        .navbar {
            background-color: #FFD608 !important;
        }

        .navbar-text {
            color: white !important;
        }

        /* Estilos para el contenido */
        .content-container {
            padding: 20px;
            margin-top: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            height: 100vh; /* Ajuste de altura para centrar verticalmente */
        }


        /* Estilos para el pie de página */
        .footer {
            background-color: #215387;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Puntos Bienestar</a>
    </div>
</nav>

<div class="container content-container text-center">
    <div class="row">
        <div class="col mb-3">
            <h1>Consultar Puntos</h1>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-4">

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form id="consulta-form" action="{{ route('consultar-puntos-post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="numero_identificacion" class="form-label">Número de Identificación:</label>
                    <br>
                    <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" required>
                </div>
                <button type="submit" class="btn btn-primary">Consultar</button>
            </form>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col">
            @isset($puntos)
                <div class="answerPoints">
                    <div>
                        <h2>Puntos del Usuario</h2>
                        <p><strong>Número de Identificación:</strong> {{ $puntos->numero_de_identificacion }}</p>
                        <p><strong>Puntos Acumulados:</strong> {{ $puntos->puntos_acumulados }}</p>
                    </div>
                    <a class="btn btn-warning" href="/">Borrar datos</a>
                </div>
            @endisset
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        Todos los derechos reservados &copy; {{ date('Y') }}
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
