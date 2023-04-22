<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //Registra usuario

    public function registro(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('token-name')->plainTextToken;

        $response =[
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    //Login usuario
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //checka email do usuario
        $user = User::where('email', $request->email)->first();

        //validar usuario
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'mensagem' => 'Nao reconhece usuario'
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;

        $response =[
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    //logout do usuario
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return [
            'mensagem' => 'logout concluido'
        ];
    }
}
