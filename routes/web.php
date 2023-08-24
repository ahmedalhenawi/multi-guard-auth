<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authAdmin\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get("Login/Admin" , "authAdmin\AdminController@loginAdmin")->name('loginAdmin');
Route::post("Admin/Check" , "authAdmin\AdminController@check")->name('adminCheck');


Route::get("admin-dashboard" , "authAdmin\AdminController@dashboard")->middleware('admin')->name('admin-dashboard');

Route::post("Logout/Admin" , "authAdmin\AdminController@logout")->name('logoutAdmin');


