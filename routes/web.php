<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::prefix('dashboard')->middleware(['auth:sanctum', 'admin'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'users' => UserController::class,
        'restaurants' => RestaurantController::class,
        'foods' => FoodController::class,
        'transactions' => TransactionController::class,
    ]);
});

Route::get('midtrans/success', [MidtransController::class, 'success']);
Route::get('midtrans/unfinished', [MidtransController::class, 'unfinished']);
Route::get('midtrans/error', [MidtransController::class, 'error']);
