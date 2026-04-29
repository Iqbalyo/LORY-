<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10">
                <h1 class="text-3xl font-extrabold text-[#1A2B3E] tracking-tight">Admin Dashboard</h1>
                <p class="text-gray-500 mt-1 text-sm">Overview performa sistem dan manajemen konten LORY.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+ Active</span>
                    </div>
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total User</h2>
                    <p class="text-4xl font-black text-[#1A2B3E] mt-1">{{ $totalUsers }}</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-all group text-white bg-gradient-to-br from-[#1A2B3E] to-[#2A3B4E]">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/10 text-white rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-blue-300 bg-white/10 px-2 py-1 rounded-lg">Database</span>
                    </div>
                    <h2 class="text-sm font-medium text-blue-100 uppercase tracking-wider">Total Soal</h2>
                    <p class="text-4xl font-black mt-1">{{ $totalQuestions }}</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl group-hover:bg-purple-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-purple-500 bg-purple-50 px-2 py-1 rounded-lg">Executed</span>
                    </div>
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Sesi Tryout</h2>
                    <p class="text-4xl font-black text-[#1A2B3E] mt-1">{{ $totalTryouts }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-bold text-[#1A2B3E] mb-4">Aksi Cepat</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <a href="{{ route('admin.users') }}" class="flex items-center p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:border-blue-500 hover:bg-blue-50 transition-all group">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-xl mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm5 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-gray-900">Lihat Data User</span>
                            <span class="text-xs text-gray-500">Kelola role, hapus, atau edit pengguna.</span>
                        </div>
                    </a>

                    <a href="{{ route('questions.create') }}" class="flex items-center p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:border-green-500 hover:bg-green-50 transition-all group">
                        <div class="p-3 bg-green-100 text-green-600 rounded-xl mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-gray-900">Tambah Soal Baru</span>
                            <span class="text-xs text-gray-500">Input pertanyaan TWK, TIU, atau TKP.</span>
                        </div>
                    </a>
                    <a href="{{ route('questions.index') }}" class="flex items-center p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:border-green-500 hover:bg-green-50 transition-all group">
                        <div class="p-3 bg-green-100 text-green-600 rounded-xl mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-gray-900">Manajemen Soal</span>
                            <span class="text-xs text-gray-500">TWK, TIU, atau TKP.</span>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>