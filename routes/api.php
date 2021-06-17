<?php

use App\Http\Controllers\ProductController;
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

Route::get('products', [ProductController::class, 'allProducts']);

Route::get('product/{id}', [ProductController::class, 'singleProduct']);
// Route::get('product', [ProductController::class, 'singleProductMsg']);

Route::delete('product/delete/{id}', [ProductController::class, 'deleteProduct']);

Route::post('product/create', [ProductController::class, 'createProduct']);

Route::put('product/update', [ProductController::class, 'updateProduct']);
Route::get('product/search/{name}', [ProductController::class, 'searchProduct']);