<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $twk = Category::where('slug', 'twk')->first();

        Question::create([
            'category_id' => $twk->id,
            'question_text' => 'Pancasila sebagai dasar negara ditetapkan pada tanggal?', //key array harus smaa kek didatabase
            'option_a' => '1 Juni 1945',
        'option_b' => '22 Juni 1945',
        'option_c' => '18 Agustus 1945',
        'option_d' => '17 Agustus 1945',
        'option_e' => '27 Oktober 1945',
        'correct_answer' => 'C',
        ]);
    }
}
