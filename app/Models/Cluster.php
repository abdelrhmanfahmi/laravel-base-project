<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'email' , 'market_id' , 'business_unit_id'];

    public function targets()
    {
        return $this->hasMany(Target::class);
    }
}
