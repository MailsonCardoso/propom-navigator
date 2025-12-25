<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'subject',
        'text',
        'options',
        'correct_answer',
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
