<?php

namespace App\Support;

use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    public static function start(): void
    {
        require_once __DIR__.'/../../routes/web.php';

        parent::start();
    }
}
