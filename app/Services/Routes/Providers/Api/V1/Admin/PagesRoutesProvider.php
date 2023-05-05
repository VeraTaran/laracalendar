<?php
namespace App\Services\Routes\Providers\Api\V1\Admin;

use App\Http\Controllers;
use App\Http\Controllers\Admin\V1\Pages\CalendarController;

use App\Http\Controllers\Api\V1\Admin\CalendarApiController;
use App\Http\Controllers\Api\V1\Admin\EventApiController;
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
        Route::group(['prefix' => 'v1', 'as' => 'api.',
           // 'namespace' => 'Api\V1\Admin',
            //'middleware' => ['auth:api']
        ], function () {
            // Events
            Route::apiResource('events',    EventApiController::class);
            Route::apiResource('calendar',  CalendarApiController::class);
        });
    }
}
