<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\IntentController;
use App\Http\Controllers\QuestionController;
use App\Models\Intent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// store conversation
Route::post('/store', [ConversationController::class, 'push']);
// get all conversation
Route::get('/pull', [ConversationController::class, 'pull']);
// clear all conversation
Route::get('/clear', [ConversationController::class, 'clear']);


Route::get('/question/{id}', [QuestionController::class, 'show']);

// clear all conversation
Route::get('/intent', [IntentController::class, 'export']);
