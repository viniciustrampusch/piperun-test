<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CalendarServiceInterface;
use App\Constants\HttpResponseStatus;
use Illuminate\Http\Request;
use App\Http\Resources\Collections\CalendarCollection;
use App\Http\Resources\CalendarResource;
use App\Http\Requests\Calendar\CalendarStoreRequest;
use App\Http\Requests\Calendar\CalendarModerateRequest;
use App\Http\Requests\Calendar\CalendarUpdateRequest;
use App\Exceptions\InvalidDateException;
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
                'data' => new CalendarResource($this->service->findById($id))
            ], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function getByUser(Request $request, $id)
    {
        try {
            return response()->json([
                'data' => new CalendarCollection($this->service->findByUserId($id, $request->all()))
            ], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CalendarStoreRequest $request)
    {
        try {
            return response()->json([
                'data' => new CalendarResource($this->service->create($request->all()))
            ], HttpResponseStatus::OK);
        } catch (InvalidDateException $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::BAD_REQUEST);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function moderate(CalendarModerateRequest $request, $id)
    {
        try {
            return response()->json([
                'data' => new CalendarResource($this->service->moderate($id, $request->all()))
            ], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CalendarUpdateRequest $request, $id)
    {
        try {
            return response()->json([
                'data' => new CalendarResource($this->service->update($id, $request->all()))
            ], HttpResponseStatus::OK);
        } catch (InvalidDateException $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::BAD_REQUEST);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return response()->json([], HttpResponseStatus::OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], HttpResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
