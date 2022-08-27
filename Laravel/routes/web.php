<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OeuvreController;

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

// Route::get('/', function () {
//     return view('components.liste');
// });

Auth::routes();

Route::get('/', [OeuvreController::class, 'index'])->name('oeuvre');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/oeuvre/create', [OeuvreController::class, 'create'])->name('oeuvre.create');
Route::get('/oeuvre/edit/{id}', [OeuvreController::class, 'edit'])->whereNumber('id')->name('oeuvre.edit');
Route::get('/oeuvre/show/{id}', [OeuvreController::class, 'show'])->whereNumber('id')->name('oeuvre.show');
Route::get('/oeuvre/delete/{id}', [OeuvreController::class, 'destroy'])->whereNumber('id')->name('oeuvre.delete');
Route::post('/oeuvre/store', [OeuvreController::class, 'store'])->name('oeuvre.store');
Route::post('/oeuvre/update/{id}', [OeuvreController::class, 'update'])->whereNumber('id')->name('oeuvre.update');
