<?php

use App\Http\Controllers\BotManController;
use App\Http\Controllers\IntentController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

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

//form page
Route::get('/', [IntentController::class, 'index']);
//create intent
Route::post('/intent/create', [IntentController::class, 'create']);
//create questions
Route::post('/question/create', [QuestionController::class, 'create']);
