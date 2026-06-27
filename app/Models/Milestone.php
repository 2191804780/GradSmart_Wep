<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'project_id',
        'name',
        'weight',
        'completion',
        'due_date',
        'is_completed',
<<<<<<< HEAD
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
=======
        'created_at'
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_completed' => 'boolean',
        'weight' => 'decimal:2',
        'completion' => 'decimal:2',
        'created_at' => 'datetime'
    ];

    // علاقة المرحلة بالمشروع الذي تنتمي إليه (Milestone belongs to a Project)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
