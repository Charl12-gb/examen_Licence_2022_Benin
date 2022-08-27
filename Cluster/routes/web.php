<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClusterController;

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
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [ClusterController::class, 'index'])->name('cluster.home');
Route::get('cluster/create', [ClusterController::class, 'create'])->name('cluster.create');
Route::post('cluster/store', [ClusterController::class, 'store'])->name('cluster.store');
Route::post('cluster/update/{id}', [ClusterController::class, 'update'])->whereNumber('id')->name('cluster.update');
Route::get('cluster/show/{id}', [ClusterController::class, 'show'])->whereNumber('id')->name('cluster.show');
Route::get('cluster/edit/{id}', [ClusterController::class, 'edit'])->whereNumber('id')->name('cluster.edit');
Route::get('cluster/delete/{id}', [ClusterController::class, 'destroy'])->whereNumber('id')->name('cluster.delete');
Route::get('cluster.commune/{id}', [ClusterController::class, 'getCommune'])->whereNumber('id')->name('cluster.commune');
Route::get('cluster.arrondissement/{id}', [ClusterController::class, 'getArrondissement'])->whereNumber('id')->name('cluster.arrondissement');
Route::get('cluster.village/{id}', [ClusterController::class, 'getVillage'])->whereNumber('id')->name('cluster.village');
