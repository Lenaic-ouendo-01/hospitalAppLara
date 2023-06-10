<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicalExamRequest;
use App\Http\Requests\StoreMedicalRecordRequest;
use App\Models\MedicalExam;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MedicalExamController extends Controller
{
    public function index()
    {
        $data = MedicalExam::where('created_by', Auth::user()->id)->get();
        return response()->json(['data' => $data ]);
    }

    public function getByMedicalRecord(int $medicalRecordId)
    {
        $data = MedicalExam::where('medical_record_id', $medicalRecordId)->get();
        return response()->json(['data' => $data ]);
    }

    public function getOne(int $id)
    {
        $data = MedicalExam::find($id);
        return response()->json(['data' => $data]);
    }

    public function store(StoreMedicalExamRequest $request)
    {
        try {
            MedicalExam::create($request->validated() + ['created_by' => Auth::user()->id]);
            return response()->json(['message' => 'Examen médical medical créé avec succès.']);
        }catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function delete(int $medicalRecordId)
    {
        $medicalRecord = MedicalExam::find($medicalRecordId);
        $medicalRecord->delete();
        return response()->json(['message' => 'Examen médical supprimé avec succès.']);
    }
}
