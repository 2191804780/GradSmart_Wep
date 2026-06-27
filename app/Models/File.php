<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'project_id',
        'filename',
        'path',
        'size',
        'version',
        'is_final_submission',
        'uploaded_by',
<<<<<<< HEAD
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

=======
        'uploaded_at'
    ];

    protected $casts = [
        'is_final_submission' => 'boolean',
        'uploaded_at' => 'datetime'
    ];

    // علاقة الملف بالمشروع الذي يخصه (File belongs to a Project)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // علاقة الملف بمن رفعه (File was uploaded by a User)
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
