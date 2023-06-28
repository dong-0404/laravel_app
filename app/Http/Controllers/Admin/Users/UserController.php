<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('users/create');
    }

    public function stores(Request $request)
    {
        // Kiem tra du lieu tu client gui len
        //  dd($request->input());
        $data = $request->all();
        //dd($data);
        $data['password'] = Hash::make($request->password);

        // tao moi user voi cac du lieu tuong ung voi du lieu duoc gan trong data
        User::create($data);
//        dd(User::all());
        echo"success create user";
    }
    public function edit($id)
    {
        $users = User::all();
        $user = $users->find($id);

        // dieu huong den view edit user và truyen sang dữ lieu về user muốn sửa đổi
        return view('users/edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $users = User::all();
        $user = $users->find($id);

        // gan du lieu gui len vao bien data
        $data = $request->all();
        // dd($data);
        // ma hoa password
        $data['password'] = Hash::make($request->password);
//        unset($data['_token']);
         $user->update($data);

//        dd($check, $data);
        echo"success update user";
    }
}
