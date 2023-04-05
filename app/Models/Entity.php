<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'parent_id' , 'organization_id'];

    public function users(){
        return $this->belongsToMany(User::class , 'entity_users');
    }
}
