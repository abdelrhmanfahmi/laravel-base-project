<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EntityRepository;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    private $entityRepository;
    
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function index(){
        $entities = $this->entityRepository->all();
        return response()->json(['data' => $entities]);
    }

    public function store(Request $request){
        $data = $request->all();
        $this->entityRepository->store($data);
        return response()->json(['message' => 'Entity Created Successfully']);
    }
}
