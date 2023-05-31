<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function createDoctor(Request $request){
        $user =  User::create([
            "name"=>$request->name, 
            "password"=>Hash::make($request->password), 
            "email"=>$request->email 
        ]);
        
        $doctor = Doctor::create([
            "number"=>$request->number,
            "birth"=>$request->birth,
            "sex"=>$request->sex,
            "nationality"=>$request->nationality,
            "language"=>$request->language,
            "hospital_services_id"=>$request->hospital_service()->id,
            "users_id"=>$request->user()->id,
        ]);

        return response()->json(["message"=>"Le médecin a été créer avec succes."]);
    }
}
