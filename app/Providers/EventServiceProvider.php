<?php

namespace App\Providers;

use App\Listeners\AumentarCarga;
use App\Listeners\DisminuirCarga;
use App\Events\SolicitudEliminada;
use App\Events\SolicitudRegistrada;
use App\Listeners\RegistrarBitacora;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\RegistrarEliminacionCarga;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SolicitudRegistrada::class =>[
            RegistrarBitacora::class,
            AumentarCarga::class,
        ],
        SolicitudEliminada::class =>[
            RegistrarEliminacionCarga::class,
            DisminuirCarga::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
