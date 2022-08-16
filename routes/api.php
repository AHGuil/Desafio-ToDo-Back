<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('tasks', [ApiController::class, 'createTask']);
Route::get('tasks', [ApiController::class, 'getAllTasks']);
Route::get('tasks/{id}', [ApiController::class, 'getTask']);
// Route::post('tasks', [ApiController::class, 'createTask']);
Route::put('tasks/{id}', [ApiController::class, 'updateTask']);
Route::delete('tasks/{id}',[ApiController::class, 'deleteTask']);