<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use App\Http\Resources\Collections\UserCollection;
use App\Constants\HttpResponseStatus;
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
                'error' => $exception->getMessage()
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
