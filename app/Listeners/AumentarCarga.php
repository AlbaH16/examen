<?php

namespace App\Listeners;

use App\Models\ControlCarga;
use App\Events\SolicitudRegistrada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AumentarCarga
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

        $carga = ControlCarga::where('id_usuario',$solicitud->id_usuario_asignado)->first();

        if($carga){
            $carga->total = $carga->total+1;
            $carga->save();
        }else{
            $nueva_carga = new ControlCarga();
            $nueva_carga->id_usuario = $solicitud->id_usuario_asignado;
            $nueva_carga->anio = 2024;
            $nueva_carga->total = 1;
            $nueva_carga->activo = 1;
            $nueva_carga->save();
        }
    }
}
