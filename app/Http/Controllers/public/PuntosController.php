<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\WellnessEventsUser;
use Illuminate\Http\Request;
use App\Models\WellnessPoint;

class PuntosController extends Controller
{
    public function index(){
        return view('public.puntos');
    }
    public function consultarPuntos(Request $request)
    {
        $numeroIdentificacion = $request->input('numero_identificacion');

        // Obtener los puntos de bienestar para el usuario con el número de identificación dado
        $puntos = WellnessPoint::where('numero_de_identificacion', $numeroIdentificacion)->first();
//        dd($puntos);
        if (!$puntos) {
            // No se encontraron puntos para el número de identificación dado
            // Puedes manejar esta situación como prefieras, por ejemplo, redirigiendo a otra página o mostrando un mensaje de error
            return redirect()->route("consultar-puntos")->with('error', 'No se encontraron el número de identificación proporcionado.');
        }

        // Obtener todos los eventos y puntos asociados para este usuario
        $eventosConPuntos = WellnessEventsUser::where('user_id', $puntos->user_id)->with('WellnessEvent')->get();
//        dd($eventosConPuntos);
        // Mapeo de datos para mostrar los eventos, puntos y fechas asociadas
        $eventos = $eventosConPuntos->map(function ($evento) {
            return [
                'nombre_evento' => $evento->WellnessEvent['name'],
                'puntos' => $evento->WellnessEvent['points'],
                'fecha_registro' => $evento->created_at->format('Y-m-d H:i:s'),
            ];
        });
//        dd($eventos);
        return view('public.puntos', compact('puntos', 'eventos'));
    }

}
