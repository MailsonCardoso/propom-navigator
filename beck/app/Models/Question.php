<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'block',
        'subject',
        'base_text',
        'text',
        'options',
        'correct_answer',
        'rationale',
        'hint',
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
