<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\ImageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getImages', [APIController::class, "getImagesApi"])->name('getImagesApi');
Route::get('/getImageById', [APIController::class, "getImageByIdApi"])->name('getImageByIdApi');

Route::post('/uploadImage', [ImageController::class, "uploadImage"])->name('uploadImageApi');
Route::post('/updateImage/{id}', [ImageController::class, "updateImage"])->name('updateImageApi');
Route::delete('/deleteImage/{id}', [ImageController::class, "deleteImage"])->name('deleteImageApi');
