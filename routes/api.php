<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;


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

// 認証
// 参考: https://www.twilio.com/blog/build-restful-api-php-laravel-sanctum-jp
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::post('/me', [AuthController::class, 'me']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// REST API
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('tasks', [TaskController::class, 'getAllTasks']);
    Route::get('tasks/{id}', [TaskController::class, 'getTask']);
    Route::post('tasks', [TaskController::class, 'createTask']);
    Route::put('tasks/{id}', [TaskController::class, 'updateTask']);
    Route::delete('tasks/{id}', [TaskController::class, 'deleteTask']);
    // 画像アップロードAPI
    Route::post("upload", [FileController::class, 'upload']);
});
