<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // تعطيل updated_at لأن الجدول يستخدم uploaded_at فقط
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'project_id',
        'filename',
        'path',
        'size',
        'version',
        'is_final_submission',
        'uploaded_by',
        'uploaded_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'is_final_submission' => 'boolean',
        'uploaded_at' => 'datetime',
    ];

    // علاقة الملف بالمشروع
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // علاقة الملف بالمستخدم الذي قام برفعه
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}