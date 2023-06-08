<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(int $userId) {
        $user = User::find($userId);
        if($user->role->code == Role::DIRECTOR &&  $user->id !== Auth::user()->id) {
            return response()->json(["error"=> "Opération dangereuse!!!"], 403);
        }

        $user->delete();
        return response()->json(["message"=>"Utilisateur a été supprimé avec succès."]);
    }

    public function createPatient() 
    {

    }

    public function createDoctor() {

    }
}
