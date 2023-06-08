<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HospitalController extends Controller
{
    //Cette function all() et getOne() ont été écrite pour pourvoir afficher les hôpitaux lorsque je penserai à faire une connexion en tant qu'Admin
    public function all()
    {
        $allService = Hospital::all();
        return response()->json([ 'data' => $allService ]);
    }

    public function getOne(int $hospitalId)
    {
        return response()->json([ 'data' => Hospital::where("id", $hospitalId)->first() ]);
    }

    public function create(CreateHospitalRequest $request){ 
        try {
            DB::beginTransaction();

            $hospital = Hospital::create([
                "name"=>$request->name,
                "description"=>$request->description,
                "number_fix"=>$request->number_fix,
                "email"=>$request->email,
                "address"=>$request->address,
                "city"=>$request->city,
                "number_mobile"=>$request->number_mobile,
                "number_urgence"=>$request->number_urgence,
                "hours"=>$request->hours,
                "language"=>$request->language,
                // "status"=>$request->status,
                // "hospital_id"=>$request->user()->director->hospital->id,
            ]);

            DB::commit();
            
            return response()->json(["message"=>"Votre hôpital a été créer avec succes."]);

        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }
    public function edit(UpdateHospitalRequest $request, int $hospitalId)
    {
        $hospital = Hospital::find($hospitalId);
        try {
            $hospital->update($request->validated());

            return response()->json(["message"=>"Les informations de l'hopital ont été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);    
            throw $throwable; 
        }
    }
    public function delete(int $userId) {
        $user = Hospital::find($userId);
        $user->delete();
        return response()->json(["message"=>"L'hôpital a été supprimé avec succès."]);
    }
}
