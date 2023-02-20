<?php

namespace App\Repository;

use App\Models\Patient;

class PatientRepository
{
    private $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }
    public function findByHospitalId($hospitalId)
    {
        return $this->patient->where('hospital_id', $hospitalId)->get();
    }

    public function store(array $data)
    {
        app('log')->info('PatientRepository1::store', $data);
        return $this->patient->create($data);
    }
}
