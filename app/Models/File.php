<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'project_id',
        'filename',
        'path',
        'size',
        'version',
        'is_final_submission',
        'uploaded_by',
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
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
