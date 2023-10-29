<?php

namespace App\Http\Controllers;

use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public $userRepository;
    private $serviceRepository;

    public function __construct(UserRepository $userRepository, ServiceRepository $serviceRepository)
    {
        $this->userRepository = $userRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
//        dd(12);
        $user = $this->userRepository->getAll()->toArray();
//        dd('return');
        $items = $this->serviceRepository->paginate($user);
        return response()->json($items);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $user = $this->userRepository->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        // $password = $request->input('password');

        $data = [
            'name' => $name,
            'email' => $email,
            // 'password' => $password,
        ];

        if ($id) {
            $user = $this->userRepository->update($id, $data);
            goto next;
        }

        $user = $this->userRepository->create($data);

        next:
        return response()->json($user, 201);
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = $this->userRepository->update($id, $data);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function updateUserProfile(Request $request, $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $data = [
            'name' => $name,
            'email' => $email,
        ];
        $newUser = $this->userRepository->update($id, $data);
        if ($newUser) {
            return response()->json($newUser);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function destroy($id)
    {
        $result = $this->userRepository->delete($id);
        if ($result) {
            return response()->json(['message' => 'user deleted']);
        }
        return response()->json(['message' => 'user not found'], 404);
    }

    public function filter(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        if ($email || $name) {
            $user = $this->userRepository->filerUser($email, $name);
            return response()->json($user);
        }
        return 0;
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 401);
        }

        if (strcmp($request->input('current_password'), $request->input('new_password')) === 0) {
            return response()->json(['message' => 'New password must be different from current password'], 401);
        }

        $this->userRepository->updatePassword($user, $request->input('new_password'));

        return response()->json(['message' => 'Password changed successfully'], 200);
    }
}
