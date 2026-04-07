<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutAnswer extends Model
{
    use HasFactory;

     protected $fillable = [
        'tryout_id',
        'question_id',
        'answer',
        'score',
    ];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
