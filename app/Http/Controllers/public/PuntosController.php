<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
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

        return view('public.puntos', compact('puntos'));
    }

}
