<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Question::with("category");
        if ($request->category) {
            $query->where("category_id", $request->category);
        }

        $questions = $query->latest()->paginate(10);
        $categories = Category::all();
        return view(
            "admin.questions.index",
            compact("questions", "categories"),
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view("admin.questions.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "category_id" => "required|exists:categories,id",
            "question_text" => "required",
            "option_a" => "required",
            "option_b" => "required",
            "option_c" => "required",
            "option_d" => "required",
            "option_e" => "required",
            "correct_answer" => "required|in:A,B,C,D,E",
            "explanation" => "nullable",

            "points_a" => "nullable|integer|min:1|max:5",
        "points_b" => "nullable|integer|min:1|max:5",
        "points_c" => "nullable|integer|min:1|max:5",
        "points_d" => "nullable|integer|min:1|max:5",
        "points_e" => "nullable|integer|min:1|max:5",
        ]);

        $question = Question::create($request->all());
        if ($question->category->slug === 'tkp') {
        $options = ['A', 'B', 'C', 'D', 'E'];
        
        foreach ($options as $opt) {
            $pointKey = "points_" . strtolower($opt); // jadi points_a, points_b, dst
            
            \App\Models\TkpScore::create([
                'question_id' => $question->id,
                'answer_option' => $opt,
                'score' => $request->$pointKey ?? 0,
            ]);
        }
    }

return redirect()->route("questions.index")->with('success', 'Soal berhasil disimpan!');    }

    public function edit(Question $question)
    {
        $categories = Category::all();
        return view("admin.questions.edit", compact("question", "categories"));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            "category_id" => "required|exists:categories,id",
            "question_text" => "required",
            "option_a" => "required",
            "option_b" => "required",
            "option_c" => "required",
            "option_d" => "required",
            "option_e" => "required",
            "correct_answer" => "required|in:A,B,C,D,E",
            "explanation" => "nullable",
        ]);

        $question->update($request->all());

        return redirect()->route("questions.index");
    }

    public function destroy(Question $question) {
        $question->delete();
        return redirect()->route('questions.index');
    }
}
