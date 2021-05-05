<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\NoteController;
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

Route::get('/user/{id}/note', [UserController::class, 'getAllNotes']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/register', [UserController::class, 'register']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);


Route::get('/note/{id}/user', [NoteController::class, 'getUser']);
Route::get('/note', [NoteController::class, 'index']);
Route::get('/note/{id}', [NoteController::class, 'show']);
Route::post('/note', [NoteController::class, 'store']);
Route::put('/note/{id}', [NoteController::class, 'update']);
Route::delete('/note/{id}', [NoteController::class, 'destroy']);
