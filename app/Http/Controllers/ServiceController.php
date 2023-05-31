<?php

namespace App\Http\Controllers;

use App\Models\HospitalService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function createService(Request $request){
        $patient = HospitalService::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "opening_hours"=>$request->opening_hours,
            "status"=>$request->status,
            "hospitals_id"=>$request->hospital()->id,
        ]);

        return response()->json(["message"=>"Le service a été créer avec succes."]);
    }
}
