<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use App\Http\Resources\Collections\UserCollection;
use App\Constants\HttpResponseStatus;
use App\Http\Resources\UserResource;
use Exception;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            return response()->json([
                'data' => new UserCollection($this->service->findAll($request->all()))
            ], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            return response()->json([
                'data' => new UserResource($this->service->findById($id))
            ], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
