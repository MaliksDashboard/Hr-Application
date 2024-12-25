<?php

use Illuminate\Support\Facades\Route;

Route::get('/employees', function () {
    return view('employees');
});
