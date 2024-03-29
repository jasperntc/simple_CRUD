<?php

use App\Http\Controllers\Account_infoController;
use App\Models\Account_info;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('account_info', Account_infoController::class);
Route::get('account_info/getAccountInfos', [Account_infoController::class, "getAccountInfos"])->name('account_info.getAccountInfos');