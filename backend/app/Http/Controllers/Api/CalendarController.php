<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CalendarServiceInterface;
use App\Constants\HttpResponseStatus;
use Illuminate\Http\Request;
use App\Http\Resources\Collections\CalendarCollection;
use App\Http\Resources\CalendarResource;
use Exception;

class CalendarController extends Controller
{
    protected $service;

    public function __construct(CalendarServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            return response()->json([
                'data' => new CalendarCollection($this->service->findAll($request->all()))
            ], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            return response()->json([
                'data' => new CalendarResource($this->service->findById($id))
            ], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
