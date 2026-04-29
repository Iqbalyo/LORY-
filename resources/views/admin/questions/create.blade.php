<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                
                <div class="px-8 py-6 border-b border-gray-50 bg-white">
                    <h2 class="text-xl font-bold text-[#1A2B3E]">Tambah Soal Baru</h2>
                    <p class="text-sm text-gray-500">Pastikan semua data soal dan poin terisi dengan benar.</p>
                </div>

                <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <div class="mb-10">
                        @include('admin.questions._form')
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('questions.index') }}" 
                           class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-all">
                            Batal
                        </a>
                        <button type="submit" 
                                class="bg-[#1A2B3E] hover:bg-black text-white font-bold py-3 px-8 rounded-2xl shadow-lg shadow-blue-900/20 active:scale-95 transition-all flex items-center gap-2">
                            <span>Simpan Soal</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>