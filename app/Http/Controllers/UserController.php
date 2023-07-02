<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
//        dd(12);
        $user = $this->userRepository->getAll();
//        dd('return');
        return response()->json($user);
    }
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if($user)
        {
            return response()->json($user);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $user = $this->userRepository->create($data);
        return response()->json($user,201);
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
        if($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
    public function destroy($id)
    {
        $result = $this->userRepository->delete($id);
        if($result)
        {
            return response()->json(['message' => 'user deleted']);
        }
        return response()->json(['message' => 'user not found'], 404);
    }
}
