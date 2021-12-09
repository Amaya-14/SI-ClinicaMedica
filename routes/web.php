<?php

use Illuminate\Support\Facades\Route;

/* Controladores de los modulos */
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\RotacionController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CajaFacturaController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* módulo personas */
Route::get('/personas/{vista}', [PersonaController::class, 'ShowPersona'])->name('registros');

Route::get('/personas/detallePaciente/{id}', [PersonaController::class, 'ShowDetalle'])->name('detalle');

Route::post('/persona/{vista}', [PersonaController::class, 'CreatePersona'])->name('nuevaPersona');

Route::put('/persona/{str}/{cod}', [PersonaController::class, 'UpadatePersona'])->name('updatePersonas');





/* módulo citas */
Route::get('/citas/{vista}', [CitaController::class, 'ShowCita'])->name('cita');









/* módulo rotacion*/
Route::get('/rotacion/personal', [RotacionController::class, 'ShowDistribucion'])->name('rotacion');

Route::post('/rotacion/personal', [RotacionController::class, 'CreateRotacion'])->name('nuevaRotacion');

Route::put('/rotacion/edit/{cod}', [RotacionController::class, 'UpdateRotacion'])->name('updateRotacion');

Route::delete('/rotacion/personal/{cod}', [RotacionController::class, 'DeleteRotacion'])->name('deleteRotacion');











/* módulo inventario */
Route::get('/almacen/productos', [AlmacenController::class, 'ShowProductos'])->name('productos');

Route::get('/almacen/{str}/{cod}', [AlmacenController::class, 'ShowInfoProducto'])->name('infoProducto');

Route::get('/almacen/inventarios', [AlmacenController::class, 'ShowInventario'])->name('inventario');

Route::post('/almacen/{str}', [AlmacenController::class, 'CreateProducto'])->name('nuevoProducto');

Route::get('/almacen/producto/medicamentos/{cod}', [AlmacenController::class, 'GetMedicamento'])->name('getMedicamento');








/* módulo caja y factura*/
Route::get('/caja/cajaChica', [CajaFacturaController::class, 'ShowCaja'])->name('Caja');