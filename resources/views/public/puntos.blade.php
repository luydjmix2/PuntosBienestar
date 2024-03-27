@extends('layouts.public')

@section('title', 'Consultar Puntos')

@section('css')
    #total-puntos {
        font-weight: bold; /* Hace que el texto dentro del elemento <td> sea negrita */
    }
    .content-container {
        min-height: 82vh !important;
        height: auto !important; /* Ajusta la altura automáticamente según el contenido */
        max-height: 100% !important; /* Limita la altura máxima al 100% de la ventana del navegador */
    }
    /* Estilos para los encabezados de semestre */
    .encabezado-semestre {
        background-color: #215387 !important;
        color: #fff !important;
        font-weight: bold;
        text-align: center;
        padding: 10px !important;
    }
@stop

@section('content')
<div class="container content-container text-center">
    <div class="row">
        <div class="col mb-3">
            <h1>Consultar Puntos</h1>
        </div>
    </div>

    <div class="row justify-content-center"> <!-- Cambiado a justify-content-center para centrar el contenido horizontalmente -->
        <div class="col-12 col-md-4"> <!-- Se especifica un ancho máximo del formulario en dispositivos grandes y se centra en dispositivos pequeños -->
            <form id="consulta-form" action="{{ route('consultar-puntos-post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="numero_identificacion" class="form-label">Número de Identificación:</label>
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
                @if($puntos)
                    <div class="answerPoints">
                        <div>
                            <h2>Puntos del Usuario</h2>
                            <p><strong>Número de Identificación:</strong> {{ $puntos->numero_de_identificacion }}</p>
                            <p><strong>Puntos Acumulados:</strong> {{ $puntos->puntos_acumulados }}</p>
                        </div>
                        <a class="btn btn-warning" href="/">Borrar datos</a>
                    </div>

                    @if($eventos->isNotEmpty())
                        <div class="row p-5">
                            <div class="col">
                                <h2>Eventos Asociados</h2>
                                <div class="table-responsive">
                                    <table id="tabla-eventos" class="table">
                                        <thead>
                                        <tr>
                                            <th>Evento</th>
                                            <th>Puntos</th>
                                            <th>Fecha de Registro</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($eventos as $evento)
                                            <tr>
                                                <td>{{ $evento['nombre_evento'] }}</td>
                                                <td>{{ $evento['puntos'] }}</td>
                                                <td>{{ $evento['fecha_registro'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td id="total-puntos">0</td>
                                            <td>--/--/-- --:--:--</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col">
                                <p>No se encontraron eventos asociados al número de identificación.</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="row">
                        <div class="col">
                            <p>No se encontraron puntos para el número de identificación proporcionado.</p>
                        </div>
                    </div>
                @endif
            @endisset
        </div>
    </div>
</div>
@endsection

@section('javascript')
// Función para calcular la suma de los puntos y mostrarla en la fila del total
function calcularTotalPuntos() {
let total = 0;
// Iterar sobre todas las celdas de la columna "Puntos"
document.querySelectorAll('#tabla-eventos tbody td:nth-child(2)').forEach((cell) => {
// Obtener el valor de la celda y sumarlo al total
total += parseInt(cell.textContent) || 0; // Parsear a entero, si es NaN, se considera como 0
});
// Mostrar el total en la celda del total
document.getElementById('total-puntos').textContent = total;
}

// Llamar a la función al cargar la página para calcular el total inicial
window.addEventListener('DOMContentLoaded', calcularTotalPuntos);


// Función para dividir los eventos por semestres
function dividirEventosPorSemestre() {
// Obtener la tabla de eventos
const tabla = document.getElementById('tabla-eventos');
// Obtener todas las filas de la tabla, excepto la fila de encabezado
const filas = Array.from(tabla.querySelectorAll('tbody tr'));
// Objeto para almacenar los eventos agrupados por semestre
const eventosPorSemestre = {};

// Iterar sobre cada fila de la tabla
filas.forEach((fila) => {
// Obtener la fecha de registro de la fila actual
const fechaRegistro = new Date(fila.cells[2].textContent);
// Obtener el año y mes de la fecha
const year = fechaRegistro.getFullYear();
const month = fechaRegistro.getMonth() + 1;
// Determinar el semestre
const semestre = (month < 7) ? 'Primer Semestre' : 'Segundo Semestre';
const semestreKey = year + '-' + semestre;

// Crear una entrada en el objeto si no existe para el semestre actual
if (!eventosPorSemestre.hasOwnProperty(semestreKey)) {
eventosPorSemestre[semestreKey] = [];
}

// Agregar la fila al arreglo de eventos del semestre correspondiente
eventosPorSemestre[semestreKey].push(fila);
});

// Limpiar la tabla de eventos
tabla.querySelector('tbody').innerHTML = '';

// Obtener todas las claves (años-semestre) del objeto eventosPorSemestre
const semestresKeys = Object.keys(eventosPorSemestre);
// Ordenar las claves de forma ascendente para mostrar los semestres más antiguos primero
semestresKeys.sort();

// Iterar sobre cada semestre en orden ascendente
semestresKeys.forEach((semestreKey) => {
// Crear una fila de encabezado para el semestre
const filaEncabezado = document.createElement('tr');
const celdaEncabezado = document.createElement('th');
celdaEncabezado.colSpan = 3;
celdaEncabezado.textContent = semestreKey;
celdaEncabezado.classList.add('encabezado-semestre'); // Agregar clase CSS
filaEncabezado.appendChild(celdaEncabezado);
tabla.querySelector('tbody').appendChild(filaEncabezado);

// Agregar todas las filas de eventos del semestre a la tabla
eventosPorSemestre[semestreKey].forEach((filaEvento) => {
tabla.querySelector('tbody').appendChild(filaEvento);
});
});
}

// Llamar a la función al cargar la página para dividir los eventos por semestre
window.addEventListener('DOMContentLoaded', dividirEventosPorSemestre);
@stop
