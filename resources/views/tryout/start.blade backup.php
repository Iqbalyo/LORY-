<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-xl font-bold mb-4">
            Tryout Dimulaiokee
        </h1>
        <div class="mb-4 text-center font-bold text-red-600">
            Sisa Waktu: <span id="timer"></span>
        </div>
        

        <p>Jumlah soal: {{ $questions->count() }}</p>
        @php
            $answers = $tryout->answers->keyBy('question_id');
        @endphp
    
       @php
           $answeredCount = $answers->count();
           $totalQuestions = $questions->count();
       @endphp

<div class="mb-4 text-center text-sm font-semibold">
    Progress:
    <span class="text-green-600">
        {{ $answeredCount }}
    </span>
    /
    <span class="text-gray-600">
        {{ $totalQuestions }}
    </span>
    soal terjawab
</div>

        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($questions as $question)
                @php
                    $answered = isset($answers[$question->id]);
                @endphp

                <a href="#question-{{ $question->id }}"
                    class="px-3 py-1 rounded text-sm font-bold
           {{ $answered ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                    {{ $loop->iteration }}
                </a>
            @endforeach
        </div>


        <ul class="mt-4 space-y-2">
            @foreach ($questions as $index => $question)
                @php
                    $isAnswered = isset($answers[$question->id]);
                @endphp
                <div id="question-{{ $question->id }}" class="p-4 border rounded mb-4" data-unanswered="{{ $isAnswered ? '0' : '1' }}">
                    <span class="text-sm font-semibold "
                        style="color: {{ $question->category->color }}">{{ $question->category->name }}</span>
                    <p class="mt-2">{{ $question->question_text }}</p>

                    <form method="POST" action="{{ route('tryout.answer') }}" class="mt-2 space-y-1">
                        @csrf

                        <input type="hidden" name="question_id" value="{{ $question->id }}">

                        @foreach (['A', 'B', 'C', 'D', 'E'] as $opt)
                            <label class="block ">
                                <input type="radio" name="answer" value="{{ $opt }}"
                                    @checked(isset($answers[$question->id]) && $answers[$question->id]->answer === $opt)>
                                {{ $question['option_' . strtolower($opt)] }}
                            </label>
                        @endforeach

                        <button type="submit" class="mt-4 text-sm text-blue-600">
                            Simpan Jawaban
                        </button>
                    </form>
                </div>
            @endforeach
        </ul>

        <form id="finishForm" method="POST" action="{{ route('tryout.finish') }}">
            @csrf
            <button type="button" id="finishBtn" class="mt-6 px-4 py-2 bg-red-600 text-white rounded">
                Selesai Tryout
            </button>
        </form>

    </div>
 <script>
    // Ambil data dari PHP
    let answeredCount = {{ $answeredCount }};
    const totalQuestions = {{ $totalQuestions }};
    let remaining = {{ $remainingSeconds }};
    
    // Ambil Elemen
    const timerEl = document.getElementById('timer');
    const finishForm = document.getElementById('finishForm');
    const finishBtn = document.getElementById('finishBtn'); // Sekarang ID ini ada

    // Fungsi format waktu
    function formatTime(seconds) {
        const m = Math.floor(seconds / 60);
        const s = seconds % 60;
        return `${m}:${s.toString().padStart(2, '0')}`;
    }

    function lockTryout() {
        document.querySelectorAll('input[type=radio], button').forEach(el => {
            el.disabled = true;
        });
    }

    // Timer Logic
    timerEl.innerText = formatTime(remaining);
    const interval = setInterval(() => {
        remaining--;
        if (remaining <= 0) {
            clearInterval(interval);
            lockTryout();
            alert('Waktu habis! Tryout diselesaikan.');
            finishForm.submit();
        }
        timerEl.innerText = formatTime(remaining);
    }, 1000);

    // Click Finish Logic
    finishBtn.addEventListener('click', (e) => {
    const unanswered = document.querySelectorAll('.bg-red-500');

    if (unanswered.length > 0) {
        e.preventDefault();
        alert(`Masih ada ${unanswered.length} soal belum dijawab`);

        const first = unanswered[0].getAttribute('href');
        document.querySelector(first).scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
        return;
    }

    if (confirm('Yakin ingin mengakhiri tryout?')) {
        finishForm.submit();
    }
});

</script>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>



</x-app-layout>
