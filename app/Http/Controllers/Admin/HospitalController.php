<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Libraries\ApiHelpers;
use App\Http\Requests\StoreHospitalRequest;
use App\Models\Hospital;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    use ApiHelpers;

    public function index(Request $request): JsonResponse
    {
        app('log')->info($request->user());
        $hospitals = Hospital::all();
        return $this->successResponse($hospitals);
    }

    public function detail(int $id) : JsonResponse
    {
        $hospital = Hospital::find($id);
        return $this->successResponse($hospital);
    }

    public function store(StoreHospitalRequest $request): JsonResponse
    {
        $hospital = Hospital::create($request->all());
        return $this->successResponse($hospital);
    }

    public function edit(Request $request, $id)
    {
        $hospital = Hospital::find($id);
        $hospital->update($request->all());
        return $this->successResponse($hospital);
    }

    public function delete(Request $request, $id)
    {
        $hospital = Hospital::find($id);
        $hospital->delete();
        return $this->successResponse($hospital);
    }
}
