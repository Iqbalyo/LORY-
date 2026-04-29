<x-app-layout>
    <div class="max-w-md mx-auto p-6">
        
        <div class="text-center mb-8">
            <h1 class="text-lg font-medium text-gray-500 uppercase tracking-widest">
                Hasil Tryout
            </h1>
            <div class="mt-4 flex flex-col items-center">
                <span class="text-5xl font-black text-[#1A2B3E]">
                    {{ $tryout->score }}
                </span>
                <p class="text-sm text-gray-400 mt-1">Skor Akhir / {{ $totalQuestions }} Soal</p>
            </div>

            @if ($tryout->is_passed)
                <div class="mt-4 inline-block px-6 py-1.5 rounded-full bg-green-100 text-green-700 text-xl font-bold uppercase tracking-wider">
                    LULUS ,GOKIL Mana Gokillll 😎
                </div>
            @else
                <div class="mt-4 inline-block px-6 py-1.5 rounded-full bg-red-100 text-red-700 text-xs font-bold uppercase tracking-wider">
                    BELUM LULUS
                </div>
            @endif
        </div>

        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm mb-8">
            <div class="flex justify-around items-center divide-x divide-gray-100">
                <div class="text-center flex-1">
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-tighter">TWK</span>
                    <span class="block text-xl font-bold text-[#1A2B3E]">{{ $tryout->score_twk }}</span>
                </div>
                
                <div class="text-center flex-1">
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-tighter">TIU</span>
                    <span class="block text-xl font-bold text-[#1A2B3E]">{{ $tryout->score_tiu }}</span>
                </div>

                <div class="text-center flex-1">
                    <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-tighter">TKP</span>
                    <span class="block text-xl font-bold text-[#1A2B3E]">{{ $tryout->score_tkp }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-3">
            <a href="{{ route('tryout.review', $tryout->id) }}"
                class="flex items-center justify-center gap-2 w-full py-4 bg-[#1A2B3E] text-white font-bold rounded-2xl shadow-lg active:scale-95 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                <span>Review Pembahasan</span>
            </a>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('tryout.history') }}" class="flex items-center justify-center py-3 bg-gray-100 text-gray-600 font-semibold rounded-2xl text-sm active:scale-95 transition-all">
                    Riwayat
                </a>
                <a href="{{ route('tryout.start') }}" class="flex items-center justify-center py-3 bg-blue-50 text-blue-600 font-semibold rounded-2xl text-sm active:scale-95 transition-all">
                    Ulangi Lagi
                </a>
            </div>

            <a href="{{ route('dashboard') }}"
                class="block w-full py-3 text-center text-gray-400 font-medium text-sm">
                Kembali ke Beranda
            </a>
        </div>

    </div>
    
    <x-bottom-nav/>

    </x-app-layout>