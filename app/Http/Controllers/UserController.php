<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\OperatingHospital;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index(Request $request): JsonResponse{
        $roleCode = $request->query('role');
        // On récupère tout les utilisateurs si on envoie pas de roleCode ?role=PATIENT ou ?role=DOCTOR
        if($roleCode !== Role::DOCTOR && $roleCode !== Role::PATIENT) {
            $data = User::query()
                ->whereNot('id', Auth::user()->id)
                ->where('created_by', Auth::user()->id)
                ->with('role')->get();
        } else {
            // On récupère tout les selon leurs role si on envoie de ?role=PATIENT ou ?role=PATIENT
            $data = User::whereHas('role', function(Builder $query) use($roleCode) {
                $query->where('code', $roleCode);
            })
                ->where('created_by', Auth::user()->id)
                ->get();
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function getOne(int $userId) {
        return response()->json(['data' => User::find($userId)]);
    }

    public function createPatient(CreatePatientUserRequest $request) {
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
        $canNotDeleteALoginDoctor = $user->role->code == Role::DOCTOR &&  $user->id === Auth::user()->id;
        $canNotDeleteALoginDirector = $user->role->code == Role::DOCTOR &&  $user->id !== Auth::user()->id;
        if($canNotDeleteALoginDoctor || $canNotDeleteALoginDirector) {
            return response()->json(["error"=> "Opération dangereuse!!!"], 403);
        }

        $user->delete();
        return response()->json(["message"=>"Utilisateur a été supprimé avec succès."]);
    }
}
