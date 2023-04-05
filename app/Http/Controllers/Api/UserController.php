<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $users = $this->userRepository->all();
        return response()->json(['data' => $users]);
    }

    public function store(Request $request){
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $this->userRepository->store($data);
        return response()->json(['message' => 'User Created Successfully']);
    }
}
