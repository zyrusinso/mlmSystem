<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\TeamComponent;
use App\Http\Livewire\TransactionComponent;
use App\Http\Livewire\UserPermissions;
use App\Http\Livewire\RewardComponent;
use App\Http\Livewire\StoreComponent;
use App\Http\Livewire\UserRoles;
use App\Http\Livewire\TeamViewComponent;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ActivateProject;
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
})->name('/');

Route::get('/activate/project', [ActivateProject::class, 'activate']);

Route::middleware(['auth', 'accessrole', 'verified', 'userVerified'])->group(function () {
    Route::get('/dashboard', HomeComponent::class)->name('dashboard');
    Route::get('/team', TeamComponent::class)->name('team');
    Route::get('/transactions', TransactionComponent::class)->name('transactions');
    Route::get('/user-permissions', UserPermissions::class)->name('user-permissions');
    Route::get('/rewards', RewardComponent::class)->name('rewards');
    Route::get('/store', StoreComponent::class)->name('store');
    Route::get('/roles', UserRoles::class)->name('roles');
});

Route::get('/team/{id}', TeamViewComponent::class)->name('team.index');
Route::get('/user/change-password', [ChangePassword::class, 'index'])->name('user.pass');
Route::post('/user/change-password', [ChangePassword::class, 'update'])->name('user.pass.update');