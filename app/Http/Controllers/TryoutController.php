<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tryout;
use App\Models\TryoutAnswer;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TryoutController extends Controller
{
    //
    public function start()
    {
        $tryout = Tryout::where("user_id", auth()->id())
            ->whereNull("finished_at")
            ->first();

        if (!$tryout) {
            $tryout = Tryout::create([
                "user_id" => auth()->id(),
                "started_at" => now(),
                "duration_minutes" => 30,
            ]);
        }

        session(["active_tryout_id" => $tryout->id]);

        $now = now();

        $startTime = \Carbon\Carbon::parse($tryout->started_at);
        $endTime = $startTime->copy()->addMinutes($tryout->duration_minutes);

        $remainingSeconds = $now->isBefore($endTime)
            ? $now->diffInSeconds($endTime)
            : 0;

        $questions = Question::with("category")->get();

        return view(
            "tryout.start",
            compact("tryout", "questions", "remainingSeconds"),
        );
    }

    public function storeAnswer(Request $request)
    {
        $request->validate([
            "question_id" => "required|exists:questions,id",
            "answer" => "required|string|max:1",
        ]);

        $tryoutId = Session::get("active_tryout_id");

        if (!$tryoutId) {
            abort(403, "Tryout Tidak aktif");
        }
        TryoutAnswer::updateOrCreate(
            [
                "tryout_id" => $tryoutId,
                "question_id" => $request->question_id,
            ],
            [
                "answer" => $request->answer,
            ],
        );

        return back();
    }

    public function finish()
    {   
        $tryoutId = session("active_tryout_id");

        if (!$tryoutId) {
            abort(403, "Tryout tidak aktif");
        }

        $tryout = Tryout::findOrFail($tryoutId);

        $answers = TryoutAnswer::with("question.category")
            ->where("tryout_id", $tryout->id)
            ->get();

        $scoreTWK = 0;
        $scoreTIU = 0;
        $scoreTKP = 0;

        foreach ($answers as $answer) {
            $question = $answer->question;

            $category = $question->category->slug; // twk / tiu / tkp

            if ($category === "tkp") {
                $tkpScore =
                    $question
                        ->tkpScores()

                        ->where("option", $answer->answer)
                        ->value("score") ?? 0;

                $answer->score = $tkpScore;
                $scoreTKP += $tkpScore;
            } else {
                if ($answer->answer === $question->correct_answer) {
                    $answer->score = 5;

                    if ($category === "twk") {
                        $scoreTWK += 5;
                    } else {
                        $scoreTIU += 5;
                    }
                } else {
                    $answer->score = 0;
                }
            }

            $answer->save();
        }

        $totalScore = $scoreTWK + $scoreTIU + $scoreTKP;
        // dd($scoreTWK, $scoreTIU, $scoreTKP);

        $lulus =
            $scoreTWK >= 30 &&
            $scoreTIU >= 30 &&
            $scoreTKP >= 35 &&
            $totalScore >= 95;

        $tryout->update([
            "score" => $totalScore,
            "score_twk" => $scoreTWK,
            "score_tiu" => $scoreTIU,
            "score_tkp" => $scoreTKP,
            "is_passed" => $lulus,
            "finished_at" => now(),
        ]);

        session()->forget("active_tryout_id");

        return redirect()->route("tryout.result", $tryout);
    }

    public function result(Tryout $tryout)
    {
        $totalQuestions = $tryout->answers()->count();

        return view("tryout.result", compact("tryout", "totalQuestions"));
    }

    public function history()
    {
        $tryouts = Tryout::where("user_id", auth()->id())
            ->orderBy("created_at", "desc")
            ->get();

        return view("tryout.history", compact("tryouts"));
    }

    public function show($id)
    {
        $tryout = Tryout::where("id", $id)
            ->where("user_id", auth()->id())
            ->firstOrFail();

        return view("tryout.show", [
            "tryout" => $tryout,
        ]);
    }

    public function progress()
    {
        $tryouts = Tryout::where("user_id", auth()->id())
            ->whereNotNull("finished_at")
            ->orderBy("finished_at")
            ->get();

        $labels = [];
        $scores = [];

        foreach ($tryouts as $index => $tryout) {
            $labels[] = "Tryout" . ($index + 1);
            $scores[] = $tryout->score;
        }

        return view("tryout.progress", compact("labels", "scores"));
    }

    public function review(Tryout $tryout)
    {
        if ($tryout->user_id !== auth()->id()) {
            abort(403);
        }
        $answers = TryoutAnswer::where("tryout_id", $tryout->id)
            ->with("question")
            ->get();

        return view("tryout.review", compact("tryout", "answers"));
    }
}
