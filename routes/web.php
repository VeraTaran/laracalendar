<?php

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

$adminPagesRoutesProvider = app(\App\Services\Routes\Providers\Admin\V1\PagesRoutesProvider::class);
$adminPagesRoutesProvider->registerRoutes();

Route::get('/', function () {
    return redirect()->route('admin/v1/page/calendar/index');
});
