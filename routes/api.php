<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mails\MailController;
use App\Http\Controllers\ProdutoController;
use App\Mail\RegistroEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);
Route::get('/produtos/nome/{nome}', [ProdutoController::class, 'showNome']);
Route::post('/resgitro', [AuthController::class, 'registro']);
Route::post('/login', [AuthController::class, 'login']);




Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/produtos', [ProdutoController::class, 'store']);
    Route::put('/produtos/{id}', [ProdutoController::class, 'update']);
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy']);
    //rota logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
