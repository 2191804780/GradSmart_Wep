<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    // تعطيل updated_at لأن الجدول يحتوي فقط على created_at
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'team_id',
        'evaluator_id',
        'evaluation_type',
        'score_documentation',
        'score_implementation',
        'score_presentation',
        'total_score',
        'feedback',
        'created_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'score_documentation' => 'decimal:2',
        'score_implementation' => 'decimal:2',
        'score_presentation' => 'decimal:2',
        'total_score' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    // علاقة التقييم بالفريق الذي تم تقييمه
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // علاقة التقييم بالمستخدم الذي قام بالتقييم (مشرف أو ممتحن)
    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}