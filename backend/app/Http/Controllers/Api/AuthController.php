<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Auth\AuthLoginRequest;
use App\Constants\HttpResponseStatus;
use App\Http\Resources\UserResource;
use App\Services\Contracts\UserServiceInterface;
use Carbon\Carbon;
use App\Exceptions\UnauthorizedException;
use Exception;

class AuthController extends Controller
{
    protected $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function login(AuthLoginRequest $request)
    {
        try {
            $token = $this->service->login($request);
            
            return response()->json([
                'access_token' => $token->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
            ], HttpResponseStatus::OK);
        } catch (UnauthorizedException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], HttpResponseStatus::UNAUTHORIZED);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
  
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Deslogado com sucesso'
        ], HttpResponseStatus::OK);
    }
  
    public function user(Request $request)
    {
        return response()->json(
            new UserResource($request->user()),
            HttpResponseStatus::OK
        );
    }
}
