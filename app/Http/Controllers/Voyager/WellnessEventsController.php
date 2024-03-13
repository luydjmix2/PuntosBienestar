<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\Controller;
use App\Models\WellnessEvent;
use App\Models\WellnessEventsUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Voyager;
use App\Models\WellnessPoint;
use App\Models\User;

class WellnessEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Verificar si el usuario no tiene ninguno de los roles permitidos
            if (!$request->user()->hasAnyRole(['admin', 'LiderBienestar', 'AuxiliarBienestar', 'EstudianteBienestar'])) {
                // Redirigir al usuario a la página de inicio del administrador
                return redirect()->route('voyager.dashboard');
            }

            return $next($request);
        });
    }
    public function customAction($id) {
        return redirect()->route('wellness-events-registers', ['event_id' => $id]);
    }

    public function showPuntosForm($event_id) {
        // Buscar el evento por su event_id
        $event = WellnessEvent::where('id', $event_id)->firstOrFail();

        // Verificar si la fecha actual está dentro del rango de fechas
        $now = Carbon::now();
        if ($now->lt($event->start_date) || $now->gt($event->end_date)) {
            // Si la fecha actual no está dentro del rango, redireccionar a una vista de error
            return view('admin.error.event_not_active', compact('event'));
        }

        // Si la fecha actual está dentro del rango, mostrar el formulario de carga de puntos
        return view('admin.wellness-events-registers', compact('event_id'));
    }
    public function savePuntosFrom(Request $request)
    {
//        dd($request);
        // Validar el número de identificación
        $request->validate([
            'identification_number' => 'required|numeric',
        ]);

        // Verificar si el número de identificación existe en la tabla wellness_points
        $wellnessPoint = WellnessPoint::where('numero_de_identificacion', $request->identification_number)->first();

        if ($wellnessPoint) {
            // Obtener la información del usuario correspondiente desde la tabla users
            $user = User::find($wellnessPoint->user_id);

            if ($user) {
                // Registrar la información en la tabla wellness_events_user
                WellnessEventsUser::firstOrCreate(
                    [
                        'wellness_event_id' => $request->id_event,
                        'user_id' => $user->id,
                    ],
                    [
                        // En caso de que se cree un nuevo registro, aquí puedes especificar los valores por defecto
                        // Si no necesitas establecer ningún valor por defecto, puedes omitir este array
                    ]
                );
                return redirect()->back()->with('success', 'Points saved successfully.');
            } else {
                return redirect()->back()->with('error', 'User not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Identification number not found.');
        }
    }

}
