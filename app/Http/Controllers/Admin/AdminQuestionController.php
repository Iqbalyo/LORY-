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

            "option_a" => "required_without:option_a_image",
            "option_a_image" =>
                "required_without:option_a|nullable|image|mimes:jpg,png,webp|max:2048",

            // Opsi B
            "option_b" => "required_without:option_b_image",
            "option_b_image" =>
                "required_without:option_b|nullable|image|mimes:jpg,png,webp|max:2048",
            
            "option_c" => "required_without:option_c_image",
            "option_c_image" =>
                "required_without:option_c|nullable|image|mimes:jpg,png,webp|max:2048",
            
            "option_d" => "required_without:option_d_image",
            "option_d_image" =>
                "required_without:option_d|nullable|image|mimes:jpg,png,webp|max:2048",
            
            "option_e" => "required_without:option_e_image",
            "option_e_image" =>
                "required_without:option_e|nullable|image|mimes:jpg,png,webp|max:2048",
          
          
                "correct_answer" => "required|in:A,B,C,D,E",
            "explanation" => "nullable",
        ]);

        //  $question = Question::create($request->all());
        // code variable diatas salah,karena gak ada proses file gambar
        $data = $request->all();

        // 🔽 HANDLE GAMBAR SOAL
        if ($request->hasFile("question_image")) {
            $data["question_image"] = $request
                ->file("question_image")
                ->store("questions", "public");
        }

        // 🔽 HANDLE GAMBAR OPSI
        foreach (["a", "b", "c", "d", "e"] as $opt) {
            $field = "option_{$opt}_image";

            if ($request->hasFile($field)) {
                $data[$field] = $request
                    ->file($field)
                    ->store("options", "public");
            }
        }

        $question = Question::create($data);
        if ($question->category->slug === "tkp") {
            $options = ["A", "B", "C", "D", "E"];

            foreach ($options as $opt) {
                $pointKey = "points_" . strtolower($opt); // jadi points_a, points_b, dst

                \App\Models\TkpScore::create([
                    "question_id" => $question->id,
                    "answer_option" => $opt,
                    "score" => $request->$pointKey ?? 0,
                ]);
            }
        }

        return redirect()
            ->route("questions.index")
            ->with("success", "Soal berhasil disimpan!");
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

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route("questions.index");
    }
}
