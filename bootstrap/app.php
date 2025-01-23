<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendLowStockReport;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class
        ]);
    })
    ->withCommands([
        SendLowStockReport::class,
    ])
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('stock:low-report')->dailyAt('08:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
