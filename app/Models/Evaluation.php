<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'team_id',
        'evaluator_id',
        'evaluation_type',
        'score_documentation',
        'score_implementation',
        'score_presentation',
        'total_score',
        'feedback',
        'created_at'
    ];

    protected $casts = [
        'score_documentation' => 'decimal:2',
        'score_implementation' => 'decimal:2',
        'score_presentation' => 'decimal:2',
        'total_score' => 'decimal:2',
        'created_at' => 'datetime'
    ];

    // علاقة التقييم بالفريق الذي تم تقييمه (Evaluation belongs to a Team)
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // علاقة التقييم بالشخص الذي قام بالتقييم (المشرف أو الممتحن)
    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
