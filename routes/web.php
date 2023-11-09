<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//All Listings
Route::get('/', [ListingController::class, 'index']);

//show Create form
Route::get('/listings/create', [ListingController::class, 'create']);

//store listing
Route::post('/listings', [ListingController::class, 'store']);

//show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

//update listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);

//delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'delete']);



















//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show'] );






// Route::get('/hello', function () {
//     return response('<h1>Hello World</h1>', 200)
//     ->header('Content-Type', 'text/plain')
//     ->header('foo', 'bar');
// });

// Route::get('/posts/{id}', function ($id) {
//     ddd($id);//dump and die
//     return response("<h1>Posts $id</h1>");
// })-> where('id', '[0-9]+');

// Route::get('/search', function (Request $request) {
//     return($request->name . ' ' . $request->city);
// });

