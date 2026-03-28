<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EntregaController;

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

        try {
            $respuestaChuck = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->timeout(15)
                ->acceptJson()
                ->get('https://api.chucknorris.io/jokes/random');

            if ($respuestaChuck->successful()) {
                $datosChuck = $respuestaChuck->json();
                $chisteIngles = $datosChuck['value'] ?? null;

                if ($chisteIngles) {
                    $respuestaTraduccion = \Illuminate\Support\Facades\Http::withoutVerifying()
                        ->timeout(20)
                        ->get('https://api.mymemory.translated.net/get', [
                            'q' => $chisteIngles,
                            'langpair' => 'en|es',
                        ]);

                    if ($respuestaTraduccion->successful()) {
                        $datosTraduccion = $respuestaTraduccion->json();
                        $traduccion = $datosTraduccion['responseData']['translatedText'] ?? null;
                        $mensajeChuck = $traduccion ?: $chisteIngles;
                    } else {
                        $mensajeChuck = $chisteIngles;
                    }
                }
            }
        } catch (\Throwable $e) {
            $mensajeChuck = 'No se pudo cargar el mensaje.';
        }

        return view('home', compact('mensajeChuck'));
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

    Route::resource('tareas', TareaController::class)
        ->parameters(['tareas' => 'tarea'])
        ->except(['show']);

    Route::get('/mis-tareas', [EntregaController::class, 'indexAlumno'])->name('mis.tareas');
    Route::post('/entregas/{tarea}', [EntregaController::class, 'store'])->name('entregas.store');
    Route::get('/revisar-entregas', [EntregaController::class, 'revisar'])->name('entregas.revisar');
    Route::get('/descargar-entrega/{entrega}', [EntregaController::class, 'descargar'])->name('entregas.descargar');
});