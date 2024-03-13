@extends('layouts.public')

@section('title', 'Consultar Puntos')

@section('css')
    /* Estilos para el formulario */
    .form-container {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Estilos para los campos de entrada */
    .form-control {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
    }

    /* Estilos para el botón */
    .btn-primary {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
    .content-container {
    min-height: 100vh !important;
    height: auto !important; /* Ajusta la altura automáticamente según el contenido */
    max-height: 100% !important; /* Limita la altura máxima al 100% de la ventana del navegador */
    }
@stop

@section('content')
<div class="container content-container text-center">
    <div class="row">
        <div class="col mb-3">
            <h1>Registro Estudiantes</h1>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-4">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning" role="alert">
                    {{ session('warning') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row text-start">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('user.register.save') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="identification_document" class="form-label">Documento de Identidad</label>
                            <input type="text" class="form-control" id="identification_document" name="identification_document" value="{{ old('identification_document') }}" pattern="[0-9]+" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Nuevo registro</button>
                        </div>
                        <!-- Enlace para ir al inicio de sesión de la administración -->
                        <div class="mb-3">
                            <a href="{{ route('voyager.login') }}" target="_blank">Ir al inicio de sesión de administración</a>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    function limpiarFormulario() {
        window.location.reload();
    }
@stop
