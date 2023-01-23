<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ScarvesManagementController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/apaszki/{scarf:slug}', [HomeController::class, 'show'])->name('scarves.show');

Auth::routes(['register' => false]);

/**
 * Admin page
 */
Route::group(['prefix' => 'admin/', 'middleware' => ['auth'], 'as' => 'admin.'], function ()
{
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('scarves', ScarvesManagementController::class);
    Route::delete('scarves/{scarf}/destroy-image/{image}', [ScarvesManagementController::class, 'destroyImage'])->name('scarves.destroy.image');
    Route::put('scarves/{scarf}/change-public}', [ScarvesManagementController::class, 'changePublic'])->name('scarves.change.public');
});

