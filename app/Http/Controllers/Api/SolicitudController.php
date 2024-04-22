<?php

namespace App\Http\Controllers\Api;
//$solicitud
//Solicitud

use App\Models\User;
use App\Models\Solicitud;
use App\Models\ControlCarga;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\SolicitudEliminada;
use App\Events\SolicitudRegistrada;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SolicitudRequest;
use App\Http\Resources\SolicitudResource;
use App\Http\Resources\SolicitudCollection;

class SolicitudController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return new SolicitudCollection(Solicitud::all()->where('id_usuario_asignado','=',Auth::id()));
        } catch (\Throwable $th) {
            Log::error('SolicitudController',
                [
                    'data'=>$request
                ]);
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitudRequest $request)
    {
        try {

            $usuario_menor_carga = ControlCarga::orderBy('total','asc')->first();
            $usuario_asesor_ventas = User::where('cve_grupo',3)->first();
            if($usuario_menor_carga != null){
                $usuario_menor_carga = $usuario_menor_carga->id_usuario;
            }else{
                $usuario_menor_carga = $usuario_asesor_ventas->id;
            }

            $solicitud = new Solicitud();
            $solicitud->id_usuario_asignado = $usuario_menor_carga;
            $solicitud->nombre_solicitante = $request->nombre_solicitante;
            $solicitud->paterno_solicitante = $request->paterno_solicitante;
            $solicitud->materno_solicitante = $request->materno_solicitante;
            $solicitud->activo = 1;
            $solicitud->fecha_solicitud = Carbon::now();
            $solicitud->save();

            event(new SolicitudRegistrada($solicitud));

            return response()->json(['message'=>'Solicitud creada y asignada con éxito']);
        } catch (\Throwable $th) {
            Log::error('SolicitudController',
                [
                    'data'=>$request
                ]);
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        try {
            return new SolicitudResource($solicitud);

        } catch (\Throwable $th) {
            Log::error('SolicitudController',
                [
                    'data'=>$solicitud
                ]);
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SolicitudRequest $request, Solicitud $solicitud)
    {
        try {
            $solicitud->update($request->validated());

            return new SolicitudResource($request);

        } catch (\Throwable $th) {
            Log::error('SolicitudController',
                [
                    'data'=>$solicitud
                ]);
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {

            $solicitud = Solicitud::where('id_solicitud',$request->id_solicitud)->first();
            $solicitud->activo = 0;
            $solicitud->save();

            event(new SolicitudEliminada($solicitud));

            return response()->json(['message'=>'Registro de solicitud eliminado'],200);
        } catch (\Throwable $th) {
            Log::error('SolicitudController',
                [
                    'data'=>$solicitud
                ]);
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }
}
