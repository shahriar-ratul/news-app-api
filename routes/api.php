<?php

use App\Http\Controllers\Api\Post\PostController;
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


Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('/categories', [PostController::class, 'getCategories']);
Route::get('/countries', [PostController::class, 'getCountries']);
Route::get('/languages', [PostController::class, 'getLanguages']);


Route::group(['prefix' => 'user'], function () {
    // login
    Route::post('/login',    [UserAuthController::class, 'userLogin']);
    // register
    Route::post('/register', [UserAuthController::class, 'userRegister']);


    // user auth routes
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', [UserProfileController::class, 'logout']);
        // user info
        Route::get('/me', [UserProfileController::class, 'getUser']);

        // user verify
        Route::get('/verify', [UserProfileController::class, 'verifyUser']);

        // user fav machine
        Route::get('/fav/posts', [MachineController::class, 'getFavPosts']);
        Route::get('/fav/posts/{id}', [MachineController::class, 'addFavPost']);
        Route::get('/fav/posts/remove/{id}', [MachineController::class, 'removeFavPost']);
    });
});





// route not found

Route::any('{segment}', function () {
    return response()->json([
        'success' => false,
        'message' => 'Route not found',
        'data' => [
            'error' => 'Invalid url.'
        ],
        'code' => 404
    ], 404);
})->where('segment', '.*');
