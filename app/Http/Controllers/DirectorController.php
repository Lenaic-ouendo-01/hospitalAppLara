<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDirectorRequest;
use App\Models\Director;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DirectorController extends Controller
{
    public function create(Request $request){

        try {
            DB::beginTransaction();

            $user =  Director::create([
                "number"=>$request->number,
                "sex"=>$request->sex,
                "nationality"=>$request->nationality,
                'user_id' => $request->user()->id,
            ]);

            DB::commit();

            return response()->json(["message"=>"Le directeur a été créer avec succes."]);


        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function edit(UpdateDirectorRequest $request, int $directorId)
    {
        $director = Director::find($directorId);

        try {
            $director->update($request->validated());

            return response()->json(["message"=>"Le directeur a été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }
}
