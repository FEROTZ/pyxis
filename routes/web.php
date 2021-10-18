<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\ProductoController;

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


//Modulo de contacto
Route::view('contacts', 'contacto');

//Ruta para funcionamiento de formulario de contacto
Route::post('contactanos', [\App\Http\Controllers\SendEmailController::class, 'send'])->name('contactanos.store');




Route::get('/', [App\Http\Controllers\WelcomeController::class, "index"])->name('welcome.show');

Route::get('/aviso', [App\Http\Controllers\AvPrivacidadController::class, "index"])->name('aviso-privacidad.watch');

Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');





Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/productos', [App\Http\Controllers\Admin\ProductoController::class, "index"])->name('productos.show');
    Route::get('/crear-productos', [App\Http\Controllers\Admin\ProductoController::class, "create"])->name('productos.create');
    Route::post('/crear-productos', [App\Http\Controllers\Admin\ProductoController::class, "store"])->name('productos.store');
    Route::get('/editar-productos/{id}', [App\Http\Controllers\Admin\ProductoController::class, "edit"])->name('productos.edit');
    Route::post('/actualizar-producto/{id}', [App\Http\Controllers\Admin\ProductoController::class, "update"])->name('productos.update');
    Route::post('/eliminar-producto/{id}', [App\Http\Controllers\Admin\ProductoController::class, "destroy"])->name('productos.delete');
    //Manejo de mensajes que llegan del formulario de contacto
    Route::get('/mensajes', [App\Http\Controllers\Admin\MessageController::class, "index"])->name('mensajes.watch');
    Route::get('/ver-mensaje/{id}', [App\Http\Controllers\Admin\MessageController::class, "show"])->name('mensajes.show');
    Route::post('/eliminar-mensaje/{id}', [App\Http\Controllers\Admin\MessageController::class, "destroy"])->name('mensajes.delete');
    //Editar la informacion de contacto, telefono, correo, etc
    Route::get('/informacion', [App\Http\Controllers\InformacionController::class, "create"])->name('informacion.create');
    Route::post('/actualizar-informacion', [App\Http\Controllers\InformacionController::class, "store"])->name('informacion.store');
    //Editar aviso de privacidad
    Route::get('/aviso-privacidad', [App\Http\Controllers\AvPrivacidadController::class, "create"])->name('aviso-privacidad.create');
    Route::post('/actualizar-aviso-privacidad', [App\Http\Controllers\AvPrivacidadController::class, "store"])->name('aviso-privacidad.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{clasificacion}/{producto}', [App\Http\Controllers\WelcomeController::class, 'show'])->name('servicios');

Route::get('/{clasificacion}/{producto}/{categoria}/{subcategoria}', [App\Http\Controllers\WelcomeController::class, 'showSubcategoria'])->name('subcategoria');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas creadas para el Administrador
//middleware -- tipo de filtro o regla (auth) indica para iniciar sesión

