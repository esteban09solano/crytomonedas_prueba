<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\UpdateCryptoPrices::class,
    ];
    /**
     * Define el cronograma de comandos de la aplicación.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Aquí registras tus comandos automáticos
        $schedule->command('crypto:update')->everyMinute();
    }

    /**
     * Registra los comandos de la aplicación.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}