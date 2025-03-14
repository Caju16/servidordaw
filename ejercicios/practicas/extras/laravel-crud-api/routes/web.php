<?php

use App\Http\Controllers\CentroCivicosController;
use App\Http\Controllers\CentroController;

Route::redirect('/', '/centros');
Route::resource('centros', CentroController::class);
