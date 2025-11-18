<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;

Route::get('/', function () {
    return view('welcome');
});
//Rutas para los ejercicios
Route::get('/Ejercicio1', [ConsultaController::class, 'insertar']);
Route::get('/Ejercicio2', [ConsultaController::class, 'pedidosUsuarioId2']);
Route::get('/Ejercicio3', [ConsultaController::class, 'informacionDetalladaPedidoYUsuario']);
Route::get('/Ejercicio4', [ConsultaController::class, 'pedidos100a250']);
Route::get('/Ejercicio5', [ConsultaController::class, 'usuarioStartR']);
Route::get('/Ejercicio6', [ConsultaController::class, 'totalPedidosUsuario5']);
Route::get('/Ejercicio7', [ConsultaController::class, 'PedidosyUsuariosOrdenadosPorTotal']);
Route::get('/Ejercicio8', [ConsultaController::class, 'sumaTotal']);
Route::get('/Ejercicio9', [ConsultaController::class, 'pedidoMenorYNombreUsuario']);
Route::get('/Ejercicio10', [ConsultaController::class, 'pedidosAgrupadoPorUsuario']);
