<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|string|min:8,max:140',
            'confirm_password' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are some fields that are required!',
                'errors' => $validator->errors(),
            ]);
        }

        $requestData = array_merge($request->all(), [
            'password' => Hash::make($request->password),
        ]);

        $user = User::create($requestData);

        return response()->json([
            'data' => $user,
            'message' => 'Successfully added the user!',
        ], Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are some fields that are required!',
                'errors' => $validator->errors(),
            ]);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Los Datos Suministrado son incorrectos :C'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken
        ]);
    }

    public function me()
    {
        
        $user = Auth::user()->with('Provider')->get();
        $userFilter = $user->filter(function ($value) {
            $me = Auth::user()->email;
            return $value->email == $me;
        })->first();
        return $userFilter;
        
        
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}

