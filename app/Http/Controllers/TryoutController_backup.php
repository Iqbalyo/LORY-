<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tryout;
use App\Models\TryoutAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TryoutController extends Controller
{
    //
    public function start()
    {
        $user = Auth::user();

        //buat sesi to
        $tryout = Tryout::create([
            'user_id' =>$user->id,
            'started_at' =>now(),
        ]);

        //ambil soal ( sementara ambil semua)

        $questions = Question::with('category')->get();

        //krim ke view
        return view('tryout.start', compact('tryout', 'questions'));
    }

    public function storeAnswer(Request $request, Tryout $tryout)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string|max:1',
        ]);

        TryoutAnswer::updateOrCreate(
            [
                'tryout_id' => $tryout->id,
                'question_id' => $request->question_id,
            ],
            [
                'answer' => $request->answer,
            ]
            );

            return back();
    }

    public function finish(Tryout $tryout)
    {
        //ambil semua jwbn + SOAL

        $answers = TryoutAnswer::with('question')
        ->where('tryout_id', $tryout->id)
        ->get();

        $score = 0;

        foreach ($answers as $answer) {
            //BENAR = +1 (sementara)
            if ($answer->answer === $answer->question->correct_answer) {
                $score += 1;
                $answer->score = 1;
            } else {
                $answer->score = 0;
            }
            $answer->save();
        }

        //update to
        $tryout->update([
            'score' => $score,
            'finished_at' => now(),
        ]);

        return redirect()->route('tryout.result', $tryout);
        
    }

    public function result(Tryout $tryout)
    {
        $totalQuestions = $tryout->answers()->count();

        return view('tryout.result', compact(
            'tryout',
            'totalQuestions',
        ));
    }
}
