<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientUserRequest;
use App\Http\Requests\UpdatePatientUserRequest;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function all()
    {
         $patientRole = Role::where('code', Role::PATIENT)->first();
         $allPatient = Patient::whereHas('user', function ($query) use($patientRole) {
             $query->where('role_id', $patientRole->id);
         })->with('user')->get();
        return response()->json([ 'data' => $allPatient ]);
    }

    public function getOne(int $patientId)
    {
        return response()->json([ 'data' => Patient::find($patientId)->with('user')->first() ]);
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
            $user->patientInformation()->update($request->validated());

            return response()->json(["message"=>"Le patient a été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

}
