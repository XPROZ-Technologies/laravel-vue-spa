<?php

namespace App\Http\Controllers;

use App\Http\Libraries\ApiHelpers;
use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;
use App\Repository\PatientRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    use ApiHelpers;

    private $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $patients = $this->patientRepository->findByHospitalId($request->user()->hospital_id);
        return $this->successResponse($patients);
    }

    public function detail(int $id) : JsonResponse
    {
        $patient = $this->patientRepository->findById($id);
        return $this->successResponse($patient);
    }

    public function store(StorePatientRequest $request): JsonResponse
    {
        $payload = $request->all();
        $payload['hospital_id'] = $request->user()->hospital_id;
        $patient = $this->patientRepository->store($payload);
        return $this->successResponse($patient);
    }
}
