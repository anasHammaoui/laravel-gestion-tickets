<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\roleController;
use Illuminate\Support\Facades\Route;

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
Route::get("/agentdashboard", function(){
    return view("agentdashboard");
}) -> name("agent");
Route::get("/admindashboard", function(){
    return view("admindashboard");
}) -> name("admin");
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// middleware for admin
Route::middleware('auth','role:admin')->group(function () {
    Route::get("/admindashboard", function(){
        return view("admin/admindashboard");
    }) -> name("admin");
});
Route::middleware('auth','role:client')->group(function () {
    Route::get("/clientdashboard", function(){
        return view("clientdashboard");
    }) -> name("client");
});


require __DIR__.'/auth.php';
