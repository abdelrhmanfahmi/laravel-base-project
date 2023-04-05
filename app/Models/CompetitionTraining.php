<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'participant_type',
        'type',
        'date_type',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'duration'
    ];
}
