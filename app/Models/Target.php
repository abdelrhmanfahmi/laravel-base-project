<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;
    protected $fillable = ['target' , 'month' , 'year' , 'cluster_id'];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class , 'cluster_id');
    }
}
