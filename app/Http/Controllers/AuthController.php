<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request){
        $directorRole = Role::where('code', Role::DIRECTOR)->first();
      $user =  User::create([
            "name"=>$request->name,
            "password"=>Hash::make($request->password),
            "email"=>$request->email,
            'role_id' => $directorRole->id
        ]);

        return response()->json(["message" => "L'utilisateur a été créer avec success "]);
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => ['required',"exists:users,email"],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            "user"=> $user,
            "token"=> $token
        ]);
    }
}
