<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration; 
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Illuminate\Foundation\Application $app) {
        // custom middleware here
    })
    ->withExceptions(function (Illuminate\Foundation\Configuration\Exceptions $exceptions) {
        // custom exception handling here
    })
    ->create();
