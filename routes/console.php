<?php

use App\Console\Commands\FetchJsonPlaceholder;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:fetch-json-placeholder', function () {
    $this->call(FetchJsonPlaceholder::class);
});
