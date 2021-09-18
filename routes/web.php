<?php

use App\Support\Router;

Router::get('/', function () {
    return file_get_contents(__DIR__.'/../views/index.html');
});
Router::post('/cdr', '\App\Http\Api\CallController@handler');
