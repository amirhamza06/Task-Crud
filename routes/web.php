<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhoneController;
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
Route::get('/phone-form', [PhoneController::class, 'create']);
Route::post('/store-input-fields', [PhoneController::class, 'store']);


Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/search_data',[ContactController::class, 'search_data']);
    Route::get('/dashboard/index',[ContactController::class,'index'])->name('contacts.index');
    Route::get('/contacts/create',[ContactController::class,'create'])->name('contacts.create');
    Route::post('/contacts/store',[ContactController::class,'store'])->name('contacts.store');
    Route::get('/contacts/{id}/edit',[ContactController::class,'edit'])->name('contacts.edit');
    Route::put('/contacts/{id}/update',[ContactController::class,'update'])->name('contacts.update');
    Route::delete('/contacts/{id}/delete',[ContactController::class,'destroy'])->name('contacts.delete');
    Route::get('/contacts/{id}/show',[ContactController::class,'show'])->name('contacts.show');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
