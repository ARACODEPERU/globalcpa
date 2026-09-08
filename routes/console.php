<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

if (class_exists(\App\Console\Commands\GenerateSitemapCommand::class)) {
    Artisan::command(\App\Console\Commands\GenerateSitemapCommand::class);
}
