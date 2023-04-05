<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateTeamRequest;
use App\Models\Entity;
use App\Models\EntityUser;
use App\Models\User;
use App\Repositories\EntityRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private $entityRepository;
    private $userRepository;

    public function __construct(EntityRepository $entityRepository, UserRepository $userRepository)
    {
        $this->entityRepository = $entityRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $entity = $this->entityRepository->all();
        return response()->json(['data' => $entity]);
    }

    public function store(Entity $entity, Request $request)
    {
        $request->validate(
            ['users' => 'required', 'array', 'min:1'],
            ['users.*' => 'required'],
            ['leader' => 'required']
        );

        $this->entityRepository->attachUsers($entity, $request->all());
        return response()->json(['message' => 'Team Created Successfully']);
    }

    public function update(Entity $entity, Request $request){
        $request->validate(
            ['users' => 'required', 'array', 'min:1'],
            ['users.*' => 'required'],
            ['leader' => 'required']
        );

        $this->entityRepository->updateUsers($entity, $request->all());
        return response()->json(['message' => 'Team Updated Successfully']);
    }

    public function destroy($id)
    {
        $this->entityRepository->destroyTeam($id);
        return response()->json(['message' => 'Team Deleted Successfully']);
    }
}
