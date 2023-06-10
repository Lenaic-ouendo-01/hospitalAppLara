<?php

namespace App\Http\Controllers;

// use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest; 
use App\Models\HospitalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function create(Request $request){
        try {
            DB::beginTransaction();

            $patient = HospitalService::create([
                "name"=>$request->name,
                "description"=>$request->description,
                "opening_hours"=>$request->opening_hours,
                "status"=>$request->status,
                "hospital_id"=>$request->user()->hospital->id,
            ]);
            DB::commit();
            
            return response()->json(["message"=>"Le service a été créer avec succes."]);

        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }
    
    public function all()
    {
        $allService = HospitalService::all();
        return response()->json([ 'data' => $allService ]);
    }


    public function getOne(int $serviceId)
    {
        return response()->json([ 'data' => HospitalService::where("id", $serviceId)->first() ]);;
    }

    // public function create(CreateServiceRequest $request){

    //     try {
    //         DB::beginTransaction();
    //         $service=HospitalService::create($request->validated());
    //         DB::commit();

    //         return response()->json(["message"=>"Le service a été créer avec succes."]);

    //     } catch (\Throwable $throwable) {
    //         DB::rollBack();
    //         Log::error($throwable);
    //         throw $throwable;
    //     }
    // }

    public function edit(UpdateServiceRequest $request, int $serviceId)
    {
        $service = HospitalService::find($serviceId);

        $service->update($request);
        try {
            $service->update($request->validated());
            return response()->json(["message"=>"Le service a été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function delete(int $serviceId) {
        $service = HospitalService::find($serviceId);
        $service->delete();
        return response()->json(["message"=>"Le service a été supprimé avec succès."]);
    }
}
