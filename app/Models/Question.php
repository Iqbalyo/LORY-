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
        "question_image", // Baru
        "option_a",
        "option_a_image", // Baru
        "option_b",
        "option_b_image", // Baru
        "option_c",
        "option_c_image", // Baru
        "option_d",
        "option_d_image", // Baru
        "option_e",
        "option_e_image", // Baru
        "correct_answer",
        "explanation"
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
