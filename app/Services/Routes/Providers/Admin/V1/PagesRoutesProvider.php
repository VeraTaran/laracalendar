<?php
namespace App\Services\Routes\Providers\Admin\V1;

use App\Http\Controllers;
use App\Http\Controllers\Admin\V1\Pages\CalendarController;
use App\Http\Controllers\Admin\V1\Pages\EventController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

class PagesRoutesProvider
{
    public function __construct()
    {

    }

    public function registerRoutes()
    {

       // Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
            Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
                Route::prefix('v1')->namespace('V1')->name('v1/')->group(static function() {
                    Route::prefix('page')->namespace('Pages')->name('page/')->group(static function() {
                        Route::prefix('calendar')->name('calendar/')->group(static function() {
                            Route::get('/',                 [CalendarController::class, 'index'])->name('index');
                            Route::get('/create',           [CalendarController::class, 'create'])->name('create');
                            Route::post('/',                [CalendarController::class, 'store'])->name('store');
                            Route::any('/update/{id}',      [CalendarController::class, 'update'])->name('update');
                        });
                        Route::prefix('event')->name('event/')->group(static function() {
                            Route::get('/',                 [EventController::class, 'index'])->name('index');
                            Route::get('/create',           [EventController::class, 'create'])->name('create');
                            Route::post('/',                [EventController::class, 'store'])->name('store');
                            Route::any('/update',           [EventController::class, 'update'])->name('update');
                        });
                    });
                });
            });
       // });
    }
}
