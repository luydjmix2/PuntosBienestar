@extends('layouts.public')

@section('title', 'Consultar Puntos')

@section('css')


@stop

@section('content')
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
@endsection

@section('javascript')

@stop
