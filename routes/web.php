<?php
use App\Http\Livewire\Categories;
use App\Http\Livewire\Users;
use App\Http\Livewire\Products;
use App\Http\Livewire\Customers;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Sales;
use App\Http\Livewire\Reports;
use App\Http\Livewire\Settings;
use Illuminate\Support\Facades\Route;

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


Route::get(uri:'categories', action:Categories::class)->name(name:'categories');
Route::get(uri:'products', action:Products::class)->name(name:'products');
Route::get(uri:'customers', action:Customers::class)->name(name:'customers');
Route::get(uri:'users', action:Users::class)->name(name:'users');
Route::get(uri:'sales', action:Sales::class)->name(name:'sales');
Route::get(uri:'reports', action:Reports::class)->name(name:'reports');

Route::get(uri:'settings', action:Settings::class)->name(name:'settings');

Route::get(uri:'dash', action:Dashboard::class)->name(name:'dash');


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
