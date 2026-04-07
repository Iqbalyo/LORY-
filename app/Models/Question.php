<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "category_id",
        "question_text",
        "option_a",
        "option_b",
        "option_c",
        "option_d",
        "option_e",
        "correct_answer",
        "explanation",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tkpScores()
    {
        return $this->hasMany(TkpScore::class);
    }
}
