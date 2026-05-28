<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
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

        //  $question = Question::create($request->all()); yg ini salah boyy
        // code variable diatas salah,karena gak ada proses file gambar
        $data = $request->all();

        // 🔽 HANDLE GAMBAR SOAL
        if ($request->hasFile("question_image")) {
            $file = $request->file("question_image");

            $filename = time() . "_" . $file->getClientOriginalName();

            $file->move(public_path("uploads/questions"), $filename);

            $data["question_image"] = "uploads/questions/" . $filename;
        }

        // 🔽 HANDLE GAMBAR OPSI
        foreach (["a", "b", "c", "d", "e"] as $opt) {
            $field = "option_{$opt}_image";

            if ($request->hasFile($field)) {
                $file = $request->file($field);

                $filename =
                    time() . "_" . $opt . "_" . $file->getClientOriginalName();

                $file->move(public_path("uploads/options"), $filename);

                $data[$field] = "uploads/options/" . $filename;
            }
        }

        $question = Question::create($data);
        if ($question->category->slug === "tkp") {
            $options = ["A", "B", "C", "D", "E"];

            foreach ($options as $opt) {
                $pointKey = "points_" . strtolower($opt);

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
            "option_a" => "nullable|string",
            "option_b" => "nullable|string",
            "option_c" => "nullable|string",
            "option_d" => "nullable|string",
            "option_e" => "nullable|string",

            "option_a_image" => "nullable|image|mimes:jpg,png,webp|max:2048",
            "option_b_image" => "nullable|image|mimes:jpg,png,webp|max:2048",
            "option_c_image" => "nullable|image|mimes:jpg,png,webp|max:2048",
            "option_d_image" => "nullable|image|mimes:jpg,png,webp|max:2048",
            "option_e_image" => "nullable|image|mimes:jpg,png,webp|max:2048",
            "correct_answer" => "required|in:A,B,C,D,E",
            "explanation" => "nullable",
        ]);

        $data = $request->except([
            "option_a_image",
            "option_b_image",
            "option_c_image",
            "option_d_image",
            "option_e_image",
        ]);

        // OPTION A
        if ($request->hasFile("option_a_image")) {
            // hapus gambar lama
            if (
                $question->option_a_image &&
                file_exists(public_path($question->option_a_image))
            ) {
                unlink(public_path($question->option_a_image));
            }

            $fileName =
                time() .
                "_" .
                $request->file("option_a_image")->getClientOriginalName();

            $request
                ->file("option_a_image")
                ->move(public_path("uploads/options"), $fileName);

            $data["option_a_image"] = "uploads/options/" . $fileName;
        } else {
            // pertahankan gambar lama
            $data["option_a_image"] = $question->option_a_image;
        }

        // OPTION B
        if ($request->hasFile("option_b_image")) {
            // hapus gambar lama
            if (
                $question->option_b_image &&
                file_exists(public_path($question->option_b_image))
            ) {
                unlink(public_path($question->option_b_image));
            }

            $fileName =
                time() .
                "_" .
                $request->file("option_b_image")->getClientOriginalName();

            $request
                ->file("option_b_image")
                ->move(public_path("uploads/options"), $fileName);

            $data["option_b_image"] = "uploads/options/" . $fileName;
        } else {
            // pertahankan gambar lama
            $data["option_b_image"] = $question->option_b_image;
        }

        // OPTION C
        if ($request->hasFile("option_c_image")) {
            // hapus gambar lama
            if (
                $question->option_c_image &&
                file_exists(public_path($question->option_c_image))
            ) {
                unlink(public_path($question->option_c_image));
            }

            $fileName =
                time() .
                "_" .
                $request->file("option_c_image")->getClientOriginalName();

            $request
                ->file("option_c_image")
                ->move(public_path("uploads/options"), $fileName);

            $data["option_c_image"] = "uploads/options/" . $fileName;
        } else {
            // pertahankan gambar lama
            $data["option_c_image"] = $question->option_c_image;
        }

        // OPTION D
        if ($request->hasFile("option_d_image")) {
            // hapus gambar lama
            if (
                $question->option_d_image &&
                file_exists(public_path($question->option_d_image))
            ) {
                unlink(public_path($question->option_d_image));
            }

            $fileName =
                time() .
                "_" .
                $request->file("option_d_image")->getClientOriginalName();

            $request
                ->file("option_d_image")
                ->move(public_path("uploads/options"), $fileName);

            $data["option_d_image"] = "uploads/options/" . $fileName;
        } else {
            // pertahankan gambar lama
            $data["option_d_image"] = $question->option_d_image;
        }

        // OPTION E
        if ($request->hasFile("option_e_image")) {
            // hapus gambar lama
            if (
                $question->option_e_image &&
                file_exists(public_path($question->option_e_image))
            ) {
                unlink(public_path($question->option_e_image));
            }

            $fileName =
                time() .
                "_" .
                $request->file("option_e_image")->getClientOriginalName();

            $request
                ->file("option_e_image")
                ->move(public_path("uploads/options"), $fileName);

            $data["option_e_image"] = "uploads/options/" . $fileName;
        } else {
            // pertahankan gambar lama
            $data["option_e_image"] = $question->option_e_image;
        }

        // bagian berikut kurang efektif,karena mengupdate semua field sekaligus,akan tergangu jika hanya menngupdate field tertentu
        // $question->update($request->all());
      
        //lebih baik kode berikut
        $question->update($data);

        return redirect()->route("questions.index");
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route("questions.index");
    }
}
