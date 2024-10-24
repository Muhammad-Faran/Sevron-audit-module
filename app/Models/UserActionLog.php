<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'description',
        'changes'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
