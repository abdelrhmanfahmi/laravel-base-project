<?php

namespace App\Repositories;

use App\Models\Entity;
use App\Models\EntityUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EntityRepository extends BaseRepository
{
    public function __construct(Entity $entity)
    {
        parent::__construct($entity);
    }

    public function all()
    {
        return $this->model->withCount('users')->get();
    }

    public function attachUsers(Entity $entity, $data)
    {
        $user_ids = [];
        $user_ids_exists = [];
        $users_InTeam = [];

        foreach ($data['users'] as $user) {
            if (!User::where('email', $user)->first()) {
                $usersData = User::create([
                    'name' => 'organization',
                    'email' => $user
                ]);

                array_push($user_ids, $usersData['id']);
                $entity->users()->syncWithoutDetaching($user_ids);

                if (!User::where('email', $data['leader'])->first()) {
                    $leader = User::create([
                        'name' => 'organization',
                        'email' => $data['leader']
                    ]);

                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader->id]);
                } else {
                    $leader_id = User::where('email', $data['leader'])->first();
                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader_id->id]);
                }
            } else {
                array_push($user_ids_exists, User::where('email', $user)->first()->id);
                array_push($users_InTeam, EntityUser::pluck('user_id')->toArray());
                array_diff($user_ids_exists, $users_InTeam[0]);

                $entity->users()->syncWithoutDetaching(array_diff($user_ids_exists, $users_InTeam[0]));

                if (!User::where('email', $data['leader'])->first()) {
                    $leader = User::create([
                        'name' => 'organization',
                        'email' => $data['leader']
                    ]);
                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader->id]);
                } else {
                    $leader_id = User::where('email', $data['leader'])->first();
                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader_id->id]);
                }
            }
        }
    }

    public function updateUsers($entity , $data)
    {
        $user_ids = [];
        $user_ids_exists = [];

        foreach ($data['users'] as $user) {
            if (!User::where('email', $user)->first()) {
                $usersData = User::create([
                    'name' => 'organization',
                    'email' => $user
                ]);

                array_push($user_ids, $usersData['id']);
                $entity->users()->sync($user_ids);

                if (!User::where('email', $data['leader'])->first()) {
                    $leader = User::create([
                        'name' => 'organization',
                        'email' => $data['leader']
                    ]);

                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader->id]);
                } else {
                    $leader_id = User::where('email', $data['leader'])->first();
                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader_id->id]);
                }
            } else {
                array_push($user_ids_exists, User::where('email', $user)->first()->id);
                $entity->users()->syncWithoutDetaching($user_ids_exists);
                
                if (!User::where('email', $data['leader'])->first()) {
                    $leader = User::create([
                        'name' => 'organization',
                        'email' => $data['leader']
                    ]);
                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader->id]);
                } else {
                    $leader_id = User::where('email', $data['leader'])->first();
                    EntityUser::where('entity_id', $entity->id)->update(['leader_id' => $leader_id->id]);
                }
            }
        }
    }

    public function destroyTeam($id)
    {
        EntityUser::where('entity_id', $id)->delete();
    }
}
