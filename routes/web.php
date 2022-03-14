<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\TeamComponent;
use App\Http\Livewire\TransactionComponent;
use App\Http\Livewire\UserPermissions;
use App\Http\Livewire\RewardComponent;
use App\Http\Livewire\StoreComponent;
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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::middleware(['auth', 'accessrole'])->group(function () {
    Route::get('/dashboard', HomeComponent::class)->name('dashboard');
    Route::get('/team', TeamComponent::class)->name('team');
    Route::get('/transactions', TransactionComponent::class)->name('transactions');
    Route::get('/user-permissions', UserPermissions::class)->name('user-permissions');
    Route::get('/rewards', RewardComponent::class)->name('rewards');
    Route::get('/store', StoreComponent::class)->name('store');
});