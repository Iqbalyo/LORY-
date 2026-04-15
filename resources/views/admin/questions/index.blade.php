<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-[#1A2B3E] tracking-tight">Daftar Soal</h1>
                    <p class="text-sm text-gray-500 mt-1">Total {{ $questions->total() }} soal tersedia di database.</p>
                </div>
                
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-2">
                    <span class="pl-3 text-xs font-bold text-gray-400 uppercase tracking-widest">Filter</span>
                    <form method="GET" class="m-0">
                        <select name="category" onchange="this.form.submit()" 
                                class="border-none focus:ring-0 text-sm font-bold text-[#1A2B3E] bg-transparent py-1.5 pl-2 pr-8 cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($questions as $question)
                    <div class="group bg-white p-5 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all flex flex-col md:flex-row md:items-center justify-between gap-4">
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="px-3 py-1 bg-blue-50 text-[#1A2B3E] text-[10px] font-black uppercase rounded-lg tracking-tighter">
                                    {{ $question->category->name ?? 'Uncategorized' }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-medium">ID: #{{ $question->id }}</span>
                            </div>
                            <h3 class="text-gray-800 font-bold leading-relaxed line-clamp-2">
                                {{ $question->question_text }}
                            </h3>
                        </div>

                        <div class="flex items-center gap-2 md:border-l md:pl-6 border-gray-100">
                            <a href="{{ route('questions.edit', $question->id) }}" 
                               class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                               title="Edit Soal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus soal ini?')"
                                        class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm"
                                        title="Hapus Soal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
                        <p class="text-gray-500 font-medium">Belum ada soal untuk kategori ini.</p>
                        <a href="{{ route('questions.create') }}" class="text-blue-600 font-bold hover:underline text-sm mt-2 block">Tambah Soal Sekarang</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8 px-4">
                {{ $questions->links() }}
            </div>
            
        </div>
    </div>
</x-app-layout>