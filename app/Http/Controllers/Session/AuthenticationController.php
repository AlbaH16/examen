<?php

namespace App\Http\Controllers\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api',['except'=>['login','logout']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request)
    {
        try {
            if(!auth()->attempt(['login'=>$request->login,'password'=>$request->password,'activo'=>'1'])){
                return response()->json(['message'=>'Unauthorized'],401);
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');

            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
            ],200);
        } catch (\Throwable $th) {
            Log::error('AuthSessionController',
                [
                    'data'=>$request
                ]);
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
       try {
        if (Auth::check()) {
            $request->user()->token()->revoke();
            return response()->json(['message'=>'Sesión cerrada'],201);
        }
        return response()->json(['message'=>'Unauthenticated'],403);

    } catch (\Throwable $th) {
        Log::error('AuthSessionController',
            [
                'data'=>$request
            ]);
        return response()->json(['error'=>$th->getMessage()],500);
    }
    }
}
