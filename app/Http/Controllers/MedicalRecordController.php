<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicalRecordRequest;
use App\Models\MedicalRecord;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $data = MedicalRecord::where('created_by', Auth::user()->id)->get();
        return response()->json(['data' => $data ]);
    }

    public function getPatientMedicalRecord(int $patientId)
    {
        $data = MedicalRecord::where('patient_id', $patientId)->get();
        return response()->json(['data' => $data ]);
    }

    public function getOne(int $id)
    {
        $data = MedicalRecord::find($id);
        return response()->json(['data' => $data]);
    }

    public function store(StoreMedicalRecordRequest $request)
    {
        try {
            MedicalRecord::create($request->validated() + ['created_by' => Auth::user()->id]);
            return response()->json(['message' => 'Dossier medical créé avec succès.']);
        }catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function delete(int $medicalRecordId)
    {
        $medicalRecord = MedicalRecord::find($medicalRecordId);
        $medicalRecord->delete();
        return response()->json(['message' => 'Dossier medical supprimé avec succès.']);
    }
}
