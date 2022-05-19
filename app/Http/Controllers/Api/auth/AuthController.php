<?php

namespace App\Http\Controllers\Api\auth;


use App\Http\Resources\User\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed','string','min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('authtoken')->accessToken;;

        return response()->json(
            [
                'message' => 'User Registered',
                'data' => ['token' => $token->plainTextToken,
                    'user' => UserResource::make($user),
                ]
            ]
        );

    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->makeVisible('password');
            if (\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authtoken');
                return response()->json(
                    [
                        'message' => 'Logged in baby',
                        'data' => [
                            'user' => UserResource::make($user),
                            'token' => $token->plainTextToken
                        ]
                    ]
                );
            } else {
                return response()->json(
                    [
                        'message' => 'the given was invalid',
                        'errors' => [
                            'password' => ["These credentials do not match our records",
                            ]
                        ],
                    ], 404
                );
            }
        } else {
            return response()->json(
                [
                    'message' => 'the given was invalid',
                    'errors' => [
                        'email' => [
                            "These credentials do not match our records"
                        ],
                    ]
                ], 401
            );
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(
            [
                'message' => 'Logged out'
            ]
        );

    }

    public function sendDeviceToken(Request $request){
        Auth::user()->update(['fcm_token' => $request->token]);
        return 'Done';
    }

}
