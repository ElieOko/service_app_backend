<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DeviseController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FacturationController;
use App\Http\Controllers\StockHistoriqueEntreeController;
use App\Http\Controllers\StockHistoriqueSortieController;

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
// Article
Route::get('/article/all',[ArticleController::class,'index']);
Route::post('/article',[ArticleController::class,'store']);
//Code
Route::get('/code/all',[CodeController::class,'index']);
Route::get('/code/generate',[CodeController::class,'create']);
// Devise
Route::get('/devise/all',[DeviseController::class,'index']);
Route::post('/devise',[DeviseController::class,'store']);
// Facturation
Route::get('/facturation/all',[FacturationController::class,'index']);
Route::post('/facturation',[FacturationController::class,'store']);
// Signal
Route::get('/signal/all',[SignalController::class,'index']);
Route::post('/signal',[SignalController::class,'store']);
// Stock
Route::get('/stock/all',[StockController::class,'index']);
Route::post('/stock',[StockController::class,'store']);
// Stock Historique Entree
Route::get('/stock/historique/entree',[StockHistoriqueEntreeController::class,'index']);
Route::post('/stock/historique/entree/add',[StockHistoriqueEntreeController::class,'store']);
// Stock Historique Sortie
Route::get('/stock/historique/sortie',[StockHistoriqueSortieController::class,'index']);
Route::post('/stock/historique/sortie/add',[StockHistoriqueSortieController::class,'store']);
// Role
Route::get('/role/all',[RoleController::class,'index']);
Route::post('/role',[RoleController::class,'store']);
//user
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
