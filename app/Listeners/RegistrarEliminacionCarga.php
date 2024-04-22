<?php

namespace App\Listeners;

use App\Models\Bitacora;
use Illuminate\Support\Carbon;
use App\Events\SolicitudEliminada;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrarEliminacionCarga
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
    public function handle(SolicitudEliminada $event): void
    {
        $solicitud = $event->solicitud;
        Log::info($solicitud->toArray());

        $nuevo_registro = new Bitacora();
        $nuevo_registro->cve_accion = 2;
        $nuevo_registro->id_usuario = $solicitud->id_usuario_asignado;
        $nuevo_registro->activo = 1;
        $nuevo_registro->fecha = Carbon::now();
        $nuevo_registro->save();
    }
}
