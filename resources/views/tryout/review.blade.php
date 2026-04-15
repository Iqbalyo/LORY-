<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">
            
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-black text-[#1A2B3E]">Review Pembahasan</h1>
                    <p class="text-gray-500 text-sm">Skor Akhir: <span class="font-bold text-blue-600">{{ $tryout->score }}</span></p>
                </div>

            </div>

            <div class="space-y-6">
                @foreach($answers as $index => $answer)
                <div class="bg-white rounded-3xl p-6 shadow-sm border {{ $answer->score > 0 ? 'border-green-100' : 'border-red-100' }}">
                    <div class="flex justify-between items-start mb-4">
                        <span class="w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-700 rounded-lg font-bold text-sm">
                            {{ $index + 1 }}
                        </span>
                        @if($answer->score > 0)
                            <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full uppercase tracking-widest">Benar (+{{ $answer->score }})</span>
                        @else
                            <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded-full uppercase tracking-widest">Salah (0)</span>
                        @endif
                    </div>

                    <p class="text-gray-800 font-bold leading-relaxed mb-6">{{ $answer->question->question_text }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="p-3 rounded-2xl bg-gray-50 border border-gray-100">
                            <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Jawaban Anda</p>
                            <p class="text-sm font-bold {{ $answer->score > 0 ? 'text-green-600' : 'text-red-600' }}">
                                Opsi {{ $answer->answer }}
                            </p>
                        </div>
                        <div class="p-3 rounded-2xl bg-blue-50 border border-blue-100">
                            <p class="text-[10px] text-blue-400 font-bold uppercase mb-1">Kunci Jawaban</p>
                            <p class="text-sm font-bold text-blue-700 uppercase">
                                Opsi {{ $answer->question->correct_answer }}
                            </p>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-2xl">
                        <h4 class="text-xs font-bold text-yellow-800 uppercase mb-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Pembahasan
                        </h4>
                        <p class="text-sm text-yellow-900 leading-relaxed italic">
                            {{ $answer->question->explanation ?? 'Tidak ada pembahasan untuk soal ini.' }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
         <x-bottom-nav/>
    </div>
</x-app-layout>