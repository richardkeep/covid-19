<?php

use App\Corona;

Route::get('/data', function () {
    return Corona::all();
});

Route::view('/', 'corona');
