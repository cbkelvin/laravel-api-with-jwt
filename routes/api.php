<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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

Route::get("list-products", [ApiController::class, "listProducts"]);
Route::get("single-product/{id}", [ApiController::class, "getSingleProduct"]);
Route::post("add-product", [ApiController::class, "createProduct"]);
Route::put("update-product/{id}", [ApiController::class, "updateProduct"]);
Route::delete("delete-product/{id}", [ApiController::class, "deleteProduct"]);
