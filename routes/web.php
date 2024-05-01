<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd('Namaa Task');
    return view('welcome');
});
