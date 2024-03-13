<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Otros estilos CSS comunes -->

    <style>
        /* Estilos para el menú superior */
        .navbar {
            background-color: #FFD608;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-text {
            color: white;
            transition: color 0.3s;
        }

        .navbar-text:hover {
            color: #f0f0f0;
        }

        /* Estilos para el contenido */
        .content-container {
            padding: 20px;
            margin-top: 20px;
            background-color: #f8f9fa; /* Color de fondo */
            background-image: linear-gradient(to bottom right, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05)); /* Textura sutil */
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: 90vh;
        }

        /* Estilos para el pie de página */
        .footer {
            background-color: #215387;
            color: white;
            padding: 20px;
            text-align: center;
        }

        @yield('css')
    </style>
</head>
<body>
@include('components.navbar')

    @yield('content')

<footer class="footer">
    <div class="container">
        Todos los derechos reservados &copy; {{ date('Y') }}
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<!-- Otros scripts JS comunes -->
<script type="text/javascript">
@yield('javascript')
</script>
</body>
</html>
