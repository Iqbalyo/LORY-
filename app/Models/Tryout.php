<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    //sering2 di cek jika db error
    protected $fillable = [
        'user_id',
        'started_at',
        'finished_at',
        'score',
        'is_passed',
        'score_twk',
        'score_tiu',
        'score_tkp',
        'duration_minutes',
    ];

    

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function answers() 
    {
        return $this->hasMany(TryoutAnswer::class);
    }
}
