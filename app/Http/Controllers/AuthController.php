<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public  $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    protected function createNewToken($token) {
        $ttl = config('jwt.ttl'); // Lấy giá trị TTL từ cấu hình

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl * 60, // Thời gian sống của token tính bằng giây
            'user' => auth()->user(),
            'role_' => auth()->user()->role->first()->name
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);

    }
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    public function userProfile()
    {
        $user = auth()->user();
        if($user) {
            $role_name = $user->role->first()->name;
        }
        return response()->json([
            'user' => $user,
            'role' => $role_name
        ]);
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 401);
        }

        if (strcmp($request->input('current_password'), $request->input('new_password')) === 0) {
            return response()->json(['message' => 'New password must be different from current password'], 401);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }


}
