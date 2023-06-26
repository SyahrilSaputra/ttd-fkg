<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\WelcomeController;
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


Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/check-login', [AuthController::class, 'checkLogin'])->name('check.login');
});
Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [WelcomeController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'role'], function(){
        Route::get('/', [RoleController::class, 'index'])->name('role')->middleware('permission:show role');
        Route::get('/create-role', [RoleController::class, 'create'])->name('create.role')->middleware('permission:create role');
        Route::post('/store-role', [RoleController::class, 'store'])->name('store.role')->middleware('permission:create role');
        Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('edit.role')->middleware('permission:update role');
        Route::post('/update-role/{id}', [RoleController::class, 'update'])->name('update.role')->middleware('permission:update role');
        Route::get('/delete-role/{id}', [RoleController::class, 'delete'])->name('delete.role')->middleware('permission:delete role');
    });
    Route::group(['prefix' => 'user'], function(){
        Route::get('/', [UserController::class, 'index'])->name('user')->middleware('permission:show user');
        Route::get('/create-user', [UserController::class, 'create'])->name('create.user')->middleware('permission:create user');
        Route::post('/store-user', [UserController::class, 'store'])->name('store.user')->middleware('permission:create user');
        Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit.user')->middleware('permission:update user');
        Route::put('/update-user/{id}', [UserController::class, 'update'])->name('update.user')->middleware('permission:update user');
        Route::get('/delete-user/{id}', [UserController::class, 'delete'])->name('delete.user')->middleware('permission:delete user');
    });
    Route::get('/signout', [AuthController::class, 'logout'])->name('signout');
});