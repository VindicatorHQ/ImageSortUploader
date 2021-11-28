<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, "home"]);
Route::get('/showImages', [PageController::class, "showImages"])->name("showImages");
Route::get('/imageUpload', [PageController::class, "imageUpload"]);
Route::get('/showImage/{id}', [PageController::class, "showImage"])->name("showImage");
Route::get('/updateImage/{id}', [PageController::class, "imageUpdate"]);
Route::get('/searchImages', [PageController::class, "searchImages"]);

Route::post('/imageUpload', [ImageController::class, 'uploadImage']);
Route::post('/updateImage/{id}', [ImageController::class, 'updateImage']);
Route::get('/deleteImage/{id}', [ImageController::class, 'deleteImage']);

