<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\OperatingHospital;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function createPatient(StoreUserRequest $request) {
        try {
            $patientRole = Role::where('code', Role::PATIENT)->first();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                "phoneNumber" => $request->phoneNumber,
                "sex" => $request->sex,
                "nationality" => $request->nationality,
                'role_id' => $patientRole->id,
                'created_by' => Auth::user()->id
            ]);

            $user->patientInformation()->create($request->validated());
            return response()->json([ 'data' => 'Patient a été créé avec succès!' ]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function createDoctor(StoreUserRequest $request) {
        $doctorRole = Role::where('code', Role::DOCTOR)->first();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                "phoneNumber" => $request->phoneNumber,
                "sex" => $request->sex,
                "nationality" => $request->nationality,
                'role_id' => $doctorRole->id,
                'created_by' => Auth::user()->id
            ]);

            OperatingHospital::create([
                'user_id' => $user->id,
                'hospital_id' => Auth::user()->hospital->id
            ]);

            return response()->json([ 'data' => 'Doctor a été créé avec succès!' ]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function delete(int $userId) {
        $user = User::find($userId);
        if($user->role->code == Role::DIRECTOR &&  $user->id !== Auth::user()->id) {
            return response()->json(["error"=> "Opération dangereuse!!!"], 403);
        }

        $user->delete();
        return response()->json(["message"=>"Utilisateur a été supprimé avec succès."]);
    }
}
