<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
  return redirect(route('login'));
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'save']);
Route::get('logout', function () {
  Auth::logout();
  return redirect(route('login'));
})->name('logout');

Route::middleware('auth')->group(function () {
  Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
  // Route::resource('domain', DomainController::class);

  Route::get('domain/create', [DomainController::class, 'create'])->name('domain.create');
  Route::get('domain/{id}', [DomainController::class, 'show'])->name('domain.show');
  Route::get('domain/delete/{id}', [DomainController::class, 'destroy'])->name('domain.destroy');
  Route::post('domain', [DomainController::class, 'store'])->name('domain.store');
  Route::patch('domain/{id}', [DomainController::class, 'update'])->name('domain.update');
  Route::post('domain/getsubdomains', [DomainController::class, 'subdomains'])->name('domain.getSubdomains');
});
