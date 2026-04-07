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
            "correct_answer" => "required|in:A,B,C,D",
            "explanation" => "nullable",
        ]);

        Question::create($request->all());

        return redirect()->route("questions.index");
    }

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
