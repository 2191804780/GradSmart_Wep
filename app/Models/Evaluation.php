<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'team_id',
        'evaluator_id',
        'evaluation_type',
        'score_documentation',
        'score_implementation',
        'score_presentation',
        'total_score',
        'feedback',
<<<<<<< HEAD
    ];

    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

=======
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
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
