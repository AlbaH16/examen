<?php

namespace App\Listeners;

use App\Models\ControlCarga;
use App\Events\SolicitudEliminada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisminuirCarga
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

        $carga = ControlCarga::where('id_usuario',$solicitud->id_usuario_asignado)->first();

        if($carga){
            if($carga->total>0){
                $carga->total = $carga->total-1;
                $carga->save();
            }
        }
    }
}
