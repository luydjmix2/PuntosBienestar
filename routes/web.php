<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/wellness-events-Up-Points/{event_id}', [\App\Http\Controllers\Voyager\WellnessEventsController::class, 'showPuntosForm'])->name('wellness-events-up-points');
    Route::post('/wellness-events-Up-Points/save', [\App\Http\Controllers\Voyager\WellnessEventsController::class, 'savePuntosFrom'])->name('wellness-events-up-points.save');

});

Route::get('/', [App\Http\Controllers\public\PuntosController::class, 'index'])->name('consultar-puntos');
Route::post('/consultarpuntos', [App\Http\Controllers\public\PuntosController::class, 'consultarPuntos'])->name('consultar-puntos-post');

Route::get('/user/register', [App\Http\Controllers\public\RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/user/register/save', [App\Http\Controllers\public\RegisterController::class, 'register'])->name("user.register.save");
