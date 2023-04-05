<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrganizationController extends Controller
{
    private $organizationRepository;
    
    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function index(){
        $organizations = $this->organizationRepository->all();
        return response()->json(['data' => $organizations]);
    }

    public function store(Request $request){
        $data = $request->all();
        $this->organizationRepository->store($data);
        return response()->json(['message' => 'Organization Created Successfully']);
    }
}
