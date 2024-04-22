<?php

namespace App\Listeners;

use App\Models\Bitacora;
use Illuminate\Support\Carbon;
use App\Events\SolicitudRegistrada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrarBitacora
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SolicitudRegistrada $event): void
    {
        $solicitud = $event->solicitud;

        $nuevo_registro = new Bitacora();
        $nuevo_registro->id_usuario = $solicitud->id_usuario_asignado;
        $nuevo_registro->cve_accion = 1;
        $nuevo_registro->activo = 1;
        $nuevo_registro->fecha = Carbon::now();
        $nuevo_registro->save();
    }
}
