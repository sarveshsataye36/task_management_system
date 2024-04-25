<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\TaskController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class,'index']);
    Route::post('/', [AuthController::class,'authenticate'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});


Route::middleware(['auth','roles:teamLeader,superAdmin'])->group(function () {
    Route::resource('task', TaskController::class);
    Route::resource('user', UserController::class);
});

Route::middleware(['auth','roles:normalEmployee,teamLeader,superAdmin'])->group(function () {
    Route::resource('task', TaskController::class);
    Route::get('task',[TaskController::class,'index'])->name('task.index');
    Route::put('task',[TaskController::class,'update'])->name('task.update');
});

Route::middleware(['auth', 'roles:superAdmin'])->group(function () {
    Route::resource('project', ProjectController::class);
});





