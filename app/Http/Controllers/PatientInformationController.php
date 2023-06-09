<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientUserRequest;
use App\Http\Requests\UpdatePatientUserRequest;
use App\Models\PatientInformation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PatientInformationController extends Controller
{
    public function all()
    {

        return response()->json([ 'data' => [] ]);
    }

    public function getOne(int $patientId)
    {
        return response()->json([ 'data' => PatientInformation::where("id", $patientId)->first() ]);
    }

    public function create(CreatePatientUserRequest $request){

        try {
            DB::beginTransaction();

            $patientRole = Role::where('code', Role::PATIENT)->first();
            $user =  User::create([
                "name"=>$request->name,
                "password"=>Hash::make($request->password),
                "email"=>$request->email,
                'role_id' => $patientRole->id,
            ]);

            $user->patientInformation()->create($request->validated());
            DB::commit();

            return response()->json(["message"=>"Le patient a été créer avec succes."]);


        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function edit(UpdatePatientUserRequest $request, int $userId)
    {
        $user = User::find($userId);

        $user->update($request->only(['name', 'email']));
        try {
            $user->update($request->validated());

            return response()->json(["message"=>"Le patient a été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

}
