<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\productoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', inicioController::class);



Route::controller(productoController::class)->group(function(){

    route::get('producto', 'principal')->name('producto.principal');
   
    Route::get('producto/{variable}/mostrar', 'mostrar')->name('producto.mostrar');
   
    route::get('producto/crear', 'crear')->name('producto.crear');

    route::post('producto','store')->name('producto.store');

    route::get('producto/{producto}/edit', 'editar')->name('producto.editar');

    Route::put('producto/{producto}', 'update')->name('producto.update');

    Route::delete('producto/{id}', 'borrar')->name('producto.borrar');

    Route::get('desactiva/{id}', 'desactivaproducto')->name('desactivapro');

    Route::get('activa/{id}', 'activaproducto')->name('activapro');
});


