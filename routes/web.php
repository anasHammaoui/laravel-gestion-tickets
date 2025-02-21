<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agent;
use App\Http\Controllers\Category;
use App\Http\Controllers\Client;
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
    Route::get("/admindashboard", [AdminController::class, "dashboard"]) -> name("admindashboard");
    Route::get("/admincategory", [Category::class, "showCategories"]) -> name("admin");
    Route::post("/categories/add", [Category::class, "addCategory"]) -> name("addCategory");
    Route::put("/categories/update/{id}", [Category::class, "updateCategory"]) -> name("updateCategory");
    Route::delete("/categories/delete/{id}", [Category::class, "deleteCategory"]) -> name("deleteCategory");
    Route::get("/adminagents", [AdminController::class, "showUsers"]) -> name("adminagents");
    Route::put("/users/update/{id}", [AdminController::class, "updateRole"]) -> name("updateRole");
    Route::delete("/users/delete/{id}", [AdminController::class, "deleteUser"]) -> name("deleteUser");

});
// middleware for agent 
Route::middleware('auth','role:agent') -> group(function (){

});
// middleware for client
Route::middleware('auth','role:client')->group(function () {
    Route::get("/clientdashboard",[Client::class,"index" ]) -> name("client");
    Route::post("/tickets/add",[Client::class,"addTicket" ]) -> name("addTicket");
});


require __DIR__.'/auth.php';
