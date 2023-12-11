<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/contacts',[ContactController::class , 'index']);
// Route::get('/contacts/list/{id}', [ContactController::class, 'show']);
Route::post('/contacts/register', [ContactController::class, 'register']);
// Route::post('/contacts', [ContactController::class, 'create']);
// Route::delete('/contacts/{idContract}', [ContactController::class, 'destroy']);
// Route::put('/contacts/{idContract}', [ContactController::class, 'update']);