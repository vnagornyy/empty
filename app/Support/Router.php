<?php

namespace App\Support;

use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    public static function start(): void
    {
        // Load our custom routes
        require_once __DIR__.'/../../routes/web.php';

        // Do initial stuff
        parent::start();
    }
}
