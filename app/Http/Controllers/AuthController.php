<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{   
    protected $authService ;
    public function __construct(AuthService $service)
{
    $this->authService = $service;
}
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $token = $this->authService->verifyUserCrendentials($credentials);
        
        if($token) {
            return response()->json([
                'token' => $token,
                'token_type' => 'bearer',
                'message' => 'login complete',
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }


    }

    public function authorizeUser(Request $request)
    {

        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'empty Token'], Response::HTTP_NOT_FOUND);
        }

        try {
            
            $user = $this->authService->getAuthenticatedUser();
            
            if (!$user) {
                return response()->json(['error' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
            }
           
            return response()->json(['user_id' => $user->id,'role' => $user->role,], Response::HTTP_ACCEPTED);

        } catch (Exception $e) {       
            
            if($e instanceof TokenInvalidException){
                return response()->json(['error' => 'sorry , yout token user is not valid'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
           
        }
    }
}
