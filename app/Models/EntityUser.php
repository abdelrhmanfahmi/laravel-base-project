<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityUser extends Model
{
    use HasFactory;
    
    protected $fillable = ['entity_id' , 'user_id' , 'leader_id'];
}
