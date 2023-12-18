<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try { 
            //$usr = Auth::user();
            $fields = $request->validate([
            'username' => 'required|string|unique:Users,username',
            'password'=>'required|string'
        ]);
        $user = User::create([
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
            'role_fk' => 1,
            'isAdmin' => false
        ]);
        // $token_genere = $user->createToken($fields['UserName'])->plainTextToken;
        // $postArray = ['APIToken' => $token_genere]; 
        // $user = User::where('UserName',$fields['UserName'])->update($postArray);
        $response = [
            'user' => $user,
            // 'token' => $token_genere
        ];  
             return response($response,201);
        } catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()]; 
            return $response;
        }
    }
    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                'username' => 'required|string',
                'password'=>'required|string',
            ]);
            $user = User::where('username',$fields['username'])->first();
            if(!$user || !Hash::check($fields['password'], $user->password)){
                return response(
                    [
                        "message"=>"Utilisateur non trouvé"
                    ],200
                );
            }
            $response = [
               'user' => $user,
            //    'token'=> $this->apiToken
            ];  
            return response($response,201);
        } catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()]; 
            return  $response;
        }
    }
}
