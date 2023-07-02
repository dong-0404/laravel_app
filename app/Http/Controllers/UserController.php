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
    public function testAbc()
    {
//        dd(12);
        return $this->userRepository->getAll();
        dd('return');
    }
    public function findUser($id)
    {
        return $this->userRepository->find($id);
        dd('return');
    }
}
