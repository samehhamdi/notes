<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\CommentController;

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

Auth::routes();

Route::get('/home', [NotesController::class , 'index']);
Route::get('/', [NotesController::class , 'index']);
Route::get('create', [NotesController::class , 'create']);
Route::post('create', [NotesController::class , 'store']);
Route::get('edit/{note}', [NotesController::class , 'edit']);
Route::get('destroy/{note}', [NotesController::class , 'destroy']);
Route::patch('edit/{note}', [NotesController::class , 'update']);
Route::get('show/{note}', [NotesController::class , 'show']);
Route::resource('Comment' , CommentController::class);
Route::post('store/{note}', [CommentController::class , 'store']);
