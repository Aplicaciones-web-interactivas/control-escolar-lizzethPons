<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CalificacionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        $mensajeChuck = 'No se pudo cargar el mensaje.';
        $debugChuck = null;

        try {
            // 1. Obtener chiste de Chuck Norris
            $respuestaChuck = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->timeout(15)
                ->acceptJson()
                ->get('https://api.chucknorris.io/jokes/random');

            if (!$respuestaChuck->successful()) {
                $debugChuck = 'Error API Chuck Norris: HTTP ' . $respuestaChuck->status();
                return view('home', compact('mensajeChuck', 'debugChuck'));
            }

            $datosChuck = $respuestaChuck->json();
            $chisteIngles = $datosChuck['value'] ?? null;

            if (!$chisteIngles) {
                $debugChuck = 'La API de Chuck Norris no devolvió el campo value.';
                return view('home', compact('mensajeChuck', 'debugChuck'));
            }

            // 2. Traducir a español con MyMemory
            $respuestaTraduccion = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->timeout(20)
                ->get('https://api.mymemory.translated.net/get', [
                    'q' => $chisteIngles,
                    'langpair' => 'en|es',
                ]);

            if (!$respuestaTraduccion->successful()) {
                $mensajeChuck = $chisteIngles;
                $debugChuck = 'La traducción falló. Se muestra el chiste en inglés. HTTP ' . $respuestaTraduccion->status();
                return view('home', compact('mensajeChuck', 'debugChuck'));
            }

            $datosTraduccion = $respuestaTraduccion->json();
            $traduccion = $datosTraduccion['responseData']['translatedText'] ?? null;

            if (!$traduccion) {
                $mensajeChuck = $chisteIngles;
                $debugChuck = 'La traducción no devolvió texto. Se muestra el chiste en inglés.';
                return view('home', compact('mensajeChuck', 'debugChuck'));
            }

            $mensajeChuck = $traduccion;

        } catch (\Throwable $e) {
            $debugChuck = 'Excepción: ' . $e->getMessage();
        }

        return view('home', compact('mensajeChuck', 'debugChuck'));
    })->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('materias', MateriaController::class)->except(['show']);
    Route::resource('horarios', HorarioController::class)->except(['show']);
    Route::resource('grupos', GrupoController::class)->except(['show']);

    Route::resource('inscripciones', InscripcionController::class)
        ->parameters(['inscripciones' => 'inscripcion'])
        ->except(['show']);

    Route::resource('calificaciones', CalificacionController::class)
        ->parameters(['calificaciones' => 'calificacion'])
        ->except(['show']);
});