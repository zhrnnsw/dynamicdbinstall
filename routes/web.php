<?php

use zhrnnsw\dynamicdbinstall\Controllers\InstallController;
use Illuminate\Support\Facades\Route;

Route::get('install', [InstallController::class, 'index']);