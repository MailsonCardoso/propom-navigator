<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'browser_info',
        'type',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
