<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'team_id',
        'evaluator_id',
        'evaluation_type',
        'score_documentation',
        'score_implementation',
        'score_presentation',
        'total_score',
        'feedback',
    ];

    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}