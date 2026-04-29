<x-guest-layout>

    <style>
        body {
            overflow: hidden;
            height: 100%;
            position: fixed;
            width: 100%;
        }


        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .question-item {
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <div class="min-h-screen p-6 pt-20 relative">


        <div class="absolute top-6 left-6 right-6 flex justify-between z-10">

            <div class="bg-white/90 backdrop-blur px-4 py-2 rounded-full text-sm font-semibold text-[#1A2B3E] shadow">
                Soal <span id="currentQuestionNumber">1</span>/<span id="totalQuestions">{{ $questions->count() }}</span>
            </div>


            <div class="bg-white/90 backdrop-blur px-4 py-2 rounded-full text-sm font-semibold text-red-500 shadow"
                id="timer">
                00:00
            </div>
        </div>

        <div class="bg-[#1A2B3E] flex-col p-2 min-h-screen rounded-2xl relative pb-24">
            @php
                $answers = $tryout->answers->keyBy('question_id');
                $answeredCount = $answers->count();
                $totalQuestions = $questions->count();
                $remainingSeconds = $remainingSeconds ?? 0;
            @endphp

            <!-- Progress Bar -->
            <div class="mb-4 px-2">
                <div class="bg-white/20 rounded-full h-2 overflow-hidden">
                    <div class="bg-green-500 h-full transition-all duration-900"
                        style="width: {{ ($answeredCount / $totalQuestions) * 100 }}%" id="progressBar"></div>
                </div>
                <div class="text-white text-xs text-center mt-1">
                    Progress: <span id="answeredCount">{{ $answeredCount }}</span>/{{ $totalQuestions }} soal terjawab
                </div>
            </div>

            <!-- Navigasi Soal (Compact) -->
            <div class="flex flex-wrap gap-1 mb-4 px-2 max-h-20 overflow-y-auto">
                @foreach ($questions as $question)
                    @php
                        $isAnswered = isset($answers[$question->id]);
                    @endphp
                    <button onclick="scrollToQuestion({{ $question->id }}, {{ $loop->index }})"
                        class="question-nav w-8 h-8 rounded-full text-xs font-bold transition-all
                            {{ $isAnswered ? 'bg-green-500 text-white' : 'bg-red-500 text-white hover:bg-red-600' }}">
                        {{ $loop->iteration }}
                    </button>
                @endforeach
            </div>

            <!-- Container Soal -->
            <div class="space-y-4" id="questionsContainer">
                @foreach ($questions as $index => $question)
                    @php
                        $isAnswered = isset($answers[$question->id]);
                    @endphp
                    <div id="question-{{ $question->id }}"
                        class="question-item bg-white rounded-2xl p-4 leading-tight transition-all max-h-[65vh] overflow-y-auto pb-28"
                        data-answered="{{ $isAnswered ? '1' : '0' }}" data-question-index="{{ $index }}"
                        style="display: {{ $index === 0 ? 'block' : 'none' }};">

                        <!-- Category Badge -->
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-3"
                            style="background-color: {{ $question->category->color }}20; color: {{ $question->category->color }}">
                            {{ $question->category->name }}
                        </span>

                        <!-- Question Text -->
                        <p class="text-gray-800 font-medium">
                            {{ $question->question_text }}
                        </p>

                        @if ($question->question_image)
                            <img src="{{ asset('storage/' . $question->question_image) }}"
                                class="mt-3 rounded-xl max-h-60 object-contain">
                        @endif

                        <!-- Options Form -->
                        <form method="POST" action="{{ route('tryout.answer') }}" class="mt-4"
                            data-question-id="{{ $question->id }}">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">

                            <div class="grid gap-3 mt-4">
                                @foreach (['A', 'B', 'C', 'D', 'E'] as $opt)
                                    @php
                                        $optionText = $question['option_' . strtolower($opt)];
                                        $isSelected =
                                            isset($answers[$question->id]) && $answers[$question->id]->answer === $opt;
                                    @endphp
                                    @if ($optionText || $question->$imageField)
                                        <label
                                            class="bg-white hover:bg-blue-50 border border-gray-200 rounded-xl p-3 cursor-pointer transition-all flex items-center shadow-sm group">
                                            <input type="radio" name="answer" value="{{ $opt }}"
                                                class="mr-3 w-4 h-4 text-blue-600" {{ $isSelected ? 'checked' : '' }}
                                                onchange="submitAnswer(this)">
                                            <span
                                                class="font-bold mr-3 text-blue-600 group-hover:scale-110 transition-transform">
                                                {{ $opt }}.
                                            </span>
                                            <div class="flex flex-col">
                                                <span class="text-gray-700">{{ $optionText }}</span>

                                                @php
                                                    $imageField = 'option_' . strtolower($opt) . '_image';
                                                @endphp

                                                @if ($question->$imageField)
                                                    <img src="{{ asset('storage/' . $question->$imageField) }}"
                                                        class="mt-2 rounded-lg max-h-40 object-contain">
                                                @endif
                                            </div>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <div class="fixed bottom-8 left-0 right-0 flex justify-center items-center gap-6 px-6">
                <button onclick="previousQuestion()"
                    class="flex items-center justify-center w-14 h-14 bg-gray-200 text-gray-700 rounded-full shadow-md active:scale-90 transition-all disabled:opacity-30"
                    id="prevBtn" aria-label="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <button onclick="nextQuestion()"
                    class="flex items-center justify-center w-14 h-14 bg-[#1A2B3E] text-white rounded-full shadow-lg active:scale-90 transition-all"
                    id="nextBtn" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

                <button id="finishBtn"
                    class="hidden px-8 h-14 bg-red-600 text-white rounded-full shadow-lg active:scale-90 transition-all font-bold tracking-wide">
                    SELESAI
                </button>
            </div>
        </div>
    </div>

    <form id="finishForm" method="POST" action="{{ route('tryout.finish') }}" style="display: none;">
        @csrf
    </form>

    <script>
        // Data dari PHP
        let questions = @json($questions->pluck('id'));
        let currentIndex = 0;
        const totalQuestions = {{ $totalQuestions }};
        let remaining = {{ $remainingSeconds }};
        let answeredStatus = @json($answers->keys()->toArray());

        const timerEl = document.getElementById('timer');
        const finishForm = document.getElementById('finishForm');
        const finishBtn = document.getElementById('finishBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressBar = document.getElementById('progressBar');
        const answeredCountSpan = document.getElementById('answeredCount');
        const currentQuestionSpan = document.getElementById('currentQuestionNumber');
        const totalQuestionsSpan = document.getElementById('totalQuestions');

        function formatTime(seconds) {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            return `${m}:${s.toString().padStart(2, '0')}`;
        }

        function updateProgress() {
            const answered = document.querySelectorAll('.question-item[data-answered="1"]').length;
            const percent = (answered / totalQuestions) * 100;
            progressBar.style.width = percent + '%';
            answeredCountSpan.textContent = answered;

            // Update navigation buttons color
            document.querySelectorAll('.question-nav').forEach((btn, idx) => {
                const questionItem = document.getElementById(`question-${questions[idx]}`);
                if (questionItem && questionItem.dataset.answered === '1') {
                    btn.classList.remove('bg-red-500');
                    btn.classList.add('bg-green-500');
                } else {
                    btn.classList.remove('bg-green-500');
                    btn.classList.add('bg-red-500');
                }
            });
        }

        function showQuestion(index) {
            // Sembunyikan semua soal
            document.querySelectorAll('.question-item').forEach((q, i) => {
                q.style.display = 'none';
            });

            // Tampilkan soal aktif
            const currentQuestion = document.getElementById(`question-${questions[index]}`);
            if (currentQuestion) {
                currentQuestion.style.display = 'block';
                currentQuestionSpan.textContent = index + 1;
            }

            // ATUR NAVIGASI TOMBOL (LOGIC BARU)
            prevBtn.disabled = index === 0;

            if (index === totalQuestions - 1) {
                // Kalau di soal terakhir: Sembunyikan Next, Munculkan Selesai
                nextBtn.classList.add('hidden');
                finishBtn.classList.remove('hidden');
            } else {
                // Kalau bukan soal terakhir: Munculkan Next, Sembunyikan Selesai
                nextBtn.classList.remove('hidden');
                finishBtn.classList.add('hidden');
            }
        }

        function nextQuestion() {
            if (currentIndex < totalQuestions - 1) {
                currentIndex++;
                showQuestion(currentIndex);
            } else {
                // Last question - check completion
                checkCompletion();
            }
        }

        function previousQuestion() {
            if (currentIndex > 0) {
                currentIndex--;
                showQuestion(currentIndex);
            }
        }

        function scrollToQuestion(questionId, index) {
            currentIndex = index;
            showQuestion(currentIndex);
        }

        function submitAnswer(radioInput) {
            const form = radioInput.closest('form');
            const formData = new FormData(form);
            const questionId = formData.get('question_id');

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update answered status
                        const questionDiv = document.getElementById(`question-${questionId}`);
                        if (questionDiv) {
                            questionDiv.dataset.answered = '1';
                        }
                        updateProgress();
                    }
                });

            // Mark as answered locally
            const questionDiv = document.getElementById(`question-${questionId}`);
            if (questionDiv) {
                questionDiv.dataset.answered = '1';
            }
            updateProgress();
        }

        function checkCompletion() {
            const unanswered = document.querySelectorAll('.question-item[data-answered="0"]');
            if (unanswered.length > 0) {
                alert(`Masih ada ${unanswered.length} soal belum dijawab`);
                // Scroll to first unanswered
                const firstUnansweredId = unanswered[0].id;
                const index = questions.findIndex(q => `question-${q}` === firstUnansweredId);
                if (index !== -1) {
                    currentIndex = index;
                    showQuestion(currentIndex);
                }
                return false;
            }
            return true;
        }

        function lockTryout() {
            document.querySelectorAll('input[type=radio], button:not(#finishBtn)').forEach(el => {
                el.disabled = true;
            });
            finishBtn.disabled = false;
        }

        // Timer Logic
        if (timerEl) {
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
        }

        // Finish Button Logic
        finishBtn.addEventListener('click', (e) => {
            if (checkCompletion()) {
                if (confirm('Yakin ingin mengakhiri tryout?')) {
                    finishForm.submit();
                }
            }
        });

        // Initialize
        updateProgress();
        showQuestion(0);

        // Smooth scroll
        document.querySelectorAll('.question-nav').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
            });
        });
    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .question-nav {
            transition: all 0.2s ease;
        }

        .question-nav:hover {
            transform: scale(1.05);
        }

        input[type="radio"] {
            accent-color: #1A2B3E;
        }

        label:has(input:checked) {
            background-color: #eff6ff;
            border-color: #3b82f6;
        }
    </style>
</x-guest-layout>
