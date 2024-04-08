<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class History extends Model

{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    use HasFactory;

    protected $fillable = [

        'prompt',

        'response'

    ];

    protected $casts = [

        "prompt" => "array",

        "response" => "array"

    ];
}
