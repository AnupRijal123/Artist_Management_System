<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\MusicController;

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

//for user
Route::post('register-user',[UserController::class,'registerUser']); 

Route::post('login',[UserController::class,'loginUser']);

Route::get('get-all-users',[UserController::class,'getAllUsers']); 

Route::get('get-single-user/{id}',[UserController::class,'getSingleUser']);

Route::patch('edit-user/{id}',[UserController::class,'editUser']);

Route::delete('delete-user/{id}',[UserController::class,'deleteUser']);


//for artist
Route::post('register-artist',[ArtistController::class,'registerArtist']);

Route::get('get-all-artist',[ArtistController::class,'getAllArtist']);

Route::get('get-single-artist/{id}',[ArtistController::class,'getSingleArtist']);

Route::patch('edit-artist/{id}',[ArtistController::class,'editArtist']);

Route::delete('delete-artist/{id}',[ArtistController::class,'deleteArtist']);


//for music

Route::post('add-music/{id}',[MusicController::class,'addMusic']);

Route::get('get-musics/{id}',[MusicController::class,'getMusics']);

Route::patch('edit-music/{id}',[MusicController::class,'editMusic']);

Route::get('get-single-music/{id}',[MusicController::class,'getSingleMusic']);

Route::delete('delete-music/{id}',[MusicController::class,'deleteMusic']);





