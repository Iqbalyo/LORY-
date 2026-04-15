<div class="space-y-6 max-w-4xl mx-auto pb-10">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <label class="text-sm font-bold text-gray-700 ml-1">Pilih Kategori</label>
            <div class="relative">
                <select name="category_id" required 
                    class="w-full pl-4 pr-10 py-3 bg-white border border-gray-200 rounded-2xl appearance-none focus:ring-2 focus:ring-[#1A2B3E] focus:border-transparent transition-all shadow-sm text-sm text-gray-700">
                    <option value="" disabled selected>Pilih kategori soal...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $question->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-sm font-bold text-gray-700 ml-1">Jawaban Benar</label>
            <div class="relative">
                <select name="correct_answer" required 
                    class="w-full pl-4 pr-10 py-3 bg-white border border-gray-200 rounded-2xl appearance-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all shadow-sm text-sm text-gray-700 font-bold">
                    @foreach(['A','B','C','D','E'] as $option)
                        <option value="{{ $option }}"
                            {{ old('correct_answer', $question->correct_answer ?? '') == $option ? 'selected' : '' }}>
                            Opsi {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-bold text-gray-700 ml-1">Isi Pertanyaan</label>
        <textarea name="question_text" required rows="4"
            placeholder="Tuliskan teks soal di sini..."
            class="w-full px-5 py-4 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#1A2B3E] focus:border-transparent transition-all shadow-sm text-sm placeholder-gray-400">{{ old('question_text', $question->question_text ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 gap-4">
    <label class="text-sm font-bold text-gray-700 ml-1">Opsi Jawaban & Poin (Khusus TKP isi poin 1-5)</label>
    
    @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
    <div class="group flex items-center bg-white border border-gray-100 p-2 rounded-2xl shadow-sm hover:shadow-md transition-all border-l-4 border-l-[#1A2B3E]">
        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center font-bold text-[#1A2B3E] bg-gray-50 rounded-xl ml-2">
            {{ strtoupper($opt) }}
        </div>

        <input type="text" name="option_{{ $opt }}" 
            value="{{ old('option_'.$opt, $question->{'option_'.$opt} ?? '') }}" 
            required placeholder="Ketik pilihan {{ $opt }}..."
            class="flex-1 border-none focus:ring-0 text-sm py-3 px-4 placeholder-gray-300">

        <div class="flex items-center bg-gray-50 rounded-xl px-3 py-1 mr-2 border border-gray-100">
            <span class="text-[10px] font-bold text-gray-400 mr-2 uppercase">Poin</span>
            <input type="number" name="points_{{ $opt }}" 
                value="{{ old('points_'.$opt) }}" 
                min="1" max="5" placeholder="0"
                class="w-12 bg-transparent border-none focus:ring-0 text-sm font-bold text-[#1A2B3E] p-0 text-center">
        </div>
    </div>
    @endforeach
</div>

    <div class="space-y-2">
        <label class="text-sm font-bold text-gray-700 ml-1">Pembahasan (Opsional)</label>
        <textarea name="explanation" rows="3"
            placeholder="Jelaskan alasan jawaban yang benar..."
            class="w-full px-5 py-4 bg-gray-50 border border-dashed border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all text-sm italic">{{ old('explanation', $question->explanation ?? '') }}</textarea>
    </div>

</div>