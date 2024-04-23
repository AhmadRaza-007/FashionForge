<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\resetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $credentials = array_merge($data, ['user_type' => 2]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken($user->email)->plainTextToken;

                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $user
                ]);
            }
            return response()->json([
                'error' => 'Invalid Credentials'
            ], 401);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'first_name' => 'required',
                'second_name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
            ]);

            $data['password'] = Hash::make($data['password']);
            $data = array_merge($data, ['user_type' => 2]);
            $user = User::create($data);

            $token = $user->createToken($user->email)->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => throw $e->getMessage() . ' ' . $e->getLine()
            ], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email'
            ]);

            $user = User::where('email', $data['email'])->first();

            if ($user) {
                $code = rand(100000, 999999);
                $user->update([
                    'reset_code' => $code,
                ]);

                Mail::to($user->email)->send(new resetCode($code));

                return response()->json([
                    'success' => true,
                    'message' => 'Reset code sent to your email'
                ]);
            }

            return response()->json([
                'error' => 'User not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => throw $e->getMessage() . '' . $e->getLine()
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $data = $request->validate([
                'reset_code' => 'required',
                'password' => 'required|confirmed',
            ]);
            $user = User::where('reset_code', $data['reset_code'])->first();
            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password),
                    'reset_code' => null,
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Password reset successfully'
                ]);
            }
            return response()->json([
                'error' => 'User not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => throw $e->getMessage() . '' . $e->getLine()
            ], 500);
        }
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
           'message' => 'Successfully logged out'
        ]);
    }
}
