<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::get('/get_penyakit', [PenyakitController::class, 'get_penyakit']);
    Route::get('/get_penyakit_by_id/{id}', [PenyakitController::class, 'get_penyakit_by_id']);
    Route::post('/create_penyakit', [PenyakitController::class, 'create_penyakit']);
    Route::delete('/delete_penyakit/{id}', [PenyakitController::class, 'delete_penyakit']);
    Route::put('/update_penyakit', [PenyakitController::class, 'update_penyakit']); // pake foto
    Route::put('/update_penyakit2', [PenyakitController::class, 'update_penyakit2']); // gak pake foto


    Route::get('/get_gejala', [GejalaController::class, 'get_gejala']);
    Route::get('/get_gejala_by_id/{id}', [GejalaController::class, 'get_gejala_by_id']);
    Route::get('/get_gejala_join_by_id/{id}', [GejalaController::class, 'get_gejala_join_by_id']); //sama aja
    Route::get('/get_gejala_join_by_id2/{id}', [GejalaController::class, 'get_gejala_join_by_id2']);// sama aja
    Route::get('/get_kuesioner_order/{id}', [GejalaController::class, 'get_kuesioner_order']);
    Route::get('/get_gejala_join/{id}', [GejalaController::class, 'get_gejala_join']);

    Route::post('/create_gejala', [GejalaController::class, 'create_gejala']);

    Route::put('/update_gejala/{code}', [GejalaController::class, 'update_gejala']);

    Route::delete('/delete_gejala/{code}', [GejalaController::class, 'delete_gejala']);
});
