<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function createPatient(Request $request){
        $user =  User::create([
            "name"=>$request->name, 
            "password"=>Hash::make($request->password), 
            "email"=>$request->email 
        ]);
        
        $patient = Patient::create([
            "number"=>$request->number,
            "nation"=>$request->nation,
            "sex"=>$request->sex,
            "birth"=>$request->birth,
            "address"=>$request->address,
            "profession"=>$request->profession,
            "allergies"=>$request->allergies,
            "history_diseases"=>$request->history_diseases,
            "ex_surgery"=>$request->ex_surgery,
            "vaccine"=>$request->vaccine,
            "hereditary"=>$request->hereditary,
            "insurance"=>$request->insurance,
            "emergency_contact"=>$request->emergency_contact,
            "blood_type"=>$request->blood_type,
            "language"=>$request->language,
            "marital_status"=>$request->marital_status,
            "users_id"=>$request->user()->id,
        ]);

        return response()->json(["message"=>"Le patient a été créer avec succes."]);
    }
}
