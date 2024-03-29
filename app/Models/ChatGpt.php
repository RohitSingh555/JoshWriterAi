<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatGpt extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'default_tokens',
        'prompt_tokens'
    ];
}
