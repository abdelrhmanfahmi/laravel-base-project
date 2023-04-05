<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionTrainingUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_training_id',
        'participant_type',
        'participant_id'
    ];

    public function participant(){
        return $this->morphTo(CompetitionTraining::class);
    }
}
