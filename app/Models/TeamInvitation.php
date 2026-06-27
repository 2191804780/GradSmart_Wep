<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamInvitation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'team_id',
        'invited_user_id',
        'invited_by',
        'member_role',
        'note',
        'status',
        'created_at',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function invitedUser()
    {
        return $this->belongsTo(User::class, 'invited_user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}