<?php

use App\Models\Game;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('clear', function() {
    Artisan::command('clear', function () {
        Artisan::call('optimize:clear');
       return back();
    });

    return back();
});


include_once(__DIR__ . '/groups/provider/playFiver.php');
include_once(__DIR__ . '/groups/gateways/suitpay.php');
include_once(__DIR__ . '/groups/auth/social.php');
include_once(__DIR__ . '/groups/layouts/app.php');

