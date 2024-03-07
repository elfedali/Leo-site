<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Log in the user using email or phone number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $user->last_login_at = now();
            $user->last_login_ip = $request->ip() . ' - ' . $request->header('User-Agent');
            return response()->json([
                'status' => true,
                'message' => __('auth.success'),
                'token' => $user->createToken('auth_token')->plainTextToken,
                'user' => $user
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => __('auth.failed'),
        ], 401);
    }


    public function logout(Request $request)
    {
        return Auth::logout();
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'username' => 'required|unique:users,username',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required|unique:users,phone',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => Hash::make($request->password)]
            ));

            // event(new Registered($user)); // send email verification to user

            $user->refresh(); // refresh user data

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken('auth_token')->plainTextToken,
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
