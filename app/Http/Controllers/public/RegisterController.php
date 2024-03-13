<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WellnessPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('public.register');
    }

    public function register(Request $request)
    {
        // Validar los campos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'identification_document' => 'required|string|max:255|unique:wellness_points,numero_de_identificacion',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validar el dominio del correo electrónico
        $domain = explode('@', $request->email)[1];
//        dd(env('DOMAIN_EMAILS_STUDENT'), $domain);
        $allowedDomain = env('DOMAIN_EMAILS_STUDENT');

        if ($allowedDomain && $domain !== $allowedDomain) {
            return redirect()->back()->with('error', 'Solo se permite el registro con correo institucional.')->withInput();
        }

        // Crear el usuario si pasa las validaciones
        // Aquí deberías agregar la lógica para crear el usuario en la base de datos
        // Crear el usuario si pasa las validaciones
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
//        dd($user->id);
        // Crear el registro de puntos de bienestar
        $wellnessPoint = WellnessPoint::create([
            'user_id' => $user->id,
            'numero_de_identificacion' => $request->identification_document,
        ]);

        // Redirigir al usuario a la página de inicio de sesión u otra página de destino
        return redirect()->back()->with('success', '¡Registro exitoso! Por favor inicia sesión.');
    }
}
