<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userLogin = User::where('email',$request->email)->first();

        if(!$userLogin)
        {
            return response([
                'message' => ['These credentials does not match our records']
            ],404);
        }

        if(!Hash::check($request->password, $userLogin->password))
        {
            return response([
                'message' => ['Password is wrong']
            ],404);
        }

        $token = $userLogin->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $userLogin,
            'token' => $token
        ],200);
    }
}
