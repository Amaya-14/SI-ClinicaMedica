<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;

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
Route::get('/personas', [PersonaController::class, 'ShowPersona'])->name('mostrarPersonas');

Route::get('/personas/{vista}/{id}', [PersonaController::class, 'ShowDetalle'])->name('detallePersona');

Route::post('/persona/create', [PersonaController::class, 'CreatePersona'])->name('nuevaPersona');

Route::put('/persona/update/{str}', [PersonaController::class, 'UpadatePersona'])->name('updatePersona');

Route::get('/persona/registro/get/{str}/{cod}', [PersonaController::class, 'GetRegistro'])->name('getRegistro');
Route::put('/persona/registro/update/{str}', [PersonaController::class, 'UpdateRegistros'])->name('updateRegistros');

Route::delete('/persona/delete/{str}/{cod}', [PersonaController::class, 'deletePersona'])->name('deletePersona');
Route::delete('/persona/registro/delete/{str}/{cod}/{p}', [PersonaController::class, 'DeleteRegistro'])->name('deleteRegistros');








/* módulo citas */
Route::get('/citas/agenda', [CitaController::class, 'ShowCita'])->name('citas');

Route::post('/cita/create', [CitaController::class, 'CreateCita'])->name('createCitas');

Route::get('/cita/get/{cod}', [CitaController::class, 'GetCita'])->name('getCita');

Route::put('/cita/update', [CitaController::class, 'UpdateCita'])->name('updateCitas');

Route::delete('/cita/delete', [CitaController::class, 'DeleteCita'])->name('deleteCita');














/* módulo rotacion*/
Route::get('/rotacion/personal', [RotacionController::class, 'ShowDistribucion'])->name('rotacion');

Route::post('/rotacion/personal', [RotacionController::class, 'CreateRotacion'])->name('nuevaRotacion');

Route::put('/rotacion/edit/{cod}', [RotacionController::class, 'UpdateRotacion'])->name('updateRotacion');

Route::delete('/rotacion/personal/{cod}', [RotacionController::class, 'DeleteRotacion'])->name('deleteRotacion');











/* módulo inventario */
Route::get('/almacen/productos', [AlmacenController::class, 'ShowProductos'])->name('productos');

Route::post('/almacen/{str}', [AlmacenController::class, 'CreateProducto'])->name('nuevoProducto');

Route::put('/almacen/{str}', [AlmacenController::class, 'UpdateProducto'])->name('updateProducto');

Route::delete('/almacen/{str}/{cod}', [AlmacenController::class, 'DeleteProducto'])->name('deleteProducto');







Route::get('/almacen/{str}/{cod}', [AlmacenController::class, 'ShowInfoProducto'])->name('infoProducto');

Route::get('/almacen/inventarios', [AlmacenController::class, 'ShowInventario'])->name('inventario');











/* módulo caja y factura*/
Route::get('/caja/cajaChica', [CajaFacturaController::class, 'ShowCaja'])->name('CajaChica');
Route::get('/caja/movimientos', [CajaFacturaController::class, 'getMovimientos'])->name('movimientos');

Route::post('/cajaChica/{str}', [CajaFacturaController::class, 'CreateCF'])->name('nuevoRegistro');

Route::put('/cajaChica/{str}', [CajaFacturaController::class, 'UpdateRegistro'])->name('updateRegistro');

Route::delete('/cajaChica/borrar/{cod}', [CajaFacturaController::class, 'DeleteRegistro'])->name('borrarRegistro');


