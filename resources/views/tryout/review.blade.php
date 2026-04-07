<h1>Pembahasan</h1>
@foreach ($answers as $answer)
    @php
        $isCorrect = $answer->answer === $answer->question->correct_answer;
    @endphp

    <div style="margin-bottom:20px;">
        <p><strong>Soal:</strong> {{ $answer->question->question_text }}</p>

        <p>
            Jawaban kamu:
            <strong style="color: {{ $isCorrect ? 'green' : 'red' }}">
                {{ strtoupper($answer->answer) }}
            </strong>
        </p>

        <p>Jawaban benar: {{ strtoupper($answer->question->correct_answer) }}</p>

        <p><em>Penjelasan:</em>
            {{ $answer->question->explanation ?? 'Belum ada pembahasan' }}
        </p>
    </div>
@endforeach
