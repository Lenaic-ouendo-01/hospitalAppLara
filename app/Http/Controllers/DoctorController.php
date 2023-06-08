<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    public function all()
    {
         $doctorRole = Role::where('code', Role::DOCTOR)->first();
         $allDoctor = Doctor::whereHas('user', function ($query) use($doctorRole) {
             $query->where('role_id', $doctorRole->id);
         })->with('user')->get();
        return response()->json([ 'data' => $allDoctor ]);
    }

    public function getOne(int $doctorId)
    {
        return response()->json([ 'data' => Doctor::find($doctorId)->with('user')->first() ]);
    }

    public function create(CreateDoctorRequest $request){

        try {
            DB::beginTransaction();

            $doctorRole = Role::where('code', Role::DOCTOR)->first();
            $user =  User::create([
                "name"=>$request->name,
                "password"=>Hash::make($request->password),
                "email"=>$request->email,
                'role_id' => $doctorRole->id,
                "hospital_service_id"=>$request->user()->hospital_service->id,
            ]);

            $user->doctorInformation()->create($request->validated());
            DB::commit();

            return response()->json(["message"=>"Le docteur a été créer avec succes."]);


        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function edit(UpdateDoctorRequest $request, int $userId)
    {
        $user = User::find($userId);

        $user->update($request->only(['name', 'email']));
        try {
            $user->doctorInformation()->update($request->validated());

            return response()->json(["message"=>"Le docteur a été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }
}
