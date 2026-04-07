<div class="fixed bottom-0 left-0 w-full bg-white border-t border-[#E1E8F0] shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">

    <div class="flex justify-around items-center py-3">

        <!-- Home -->
        <a href="/dashboard" class="flex flex-col items-center 
        {{ request()->is('dashboard') ? 'text-[#1A2B3E]' : 'text-gray-400' }}">

            <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-6 h-6 mb-1" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M3 10l9-7 9 7v11a2 2 0 01-2 2h-4a2 2 0 01-2-2V14H9v5a2 2 0 01-2 2H3z"/>
            </svg>

            <span class="text-xs font-medium">Beranda</span>
        </a>

        <!-- Result / History -->
        <a href="{{ route('tryout.history') }}" class="flex flex-col items-center 
        {{ request()->routeIs('tryout.history') ? 'text-[#1A2B3E]' : 'text-gray-400' }}">

            <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-6 h-6 mb-1" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M9 17v-6h13M9 17l-4-4m4 4l-4 4"/>
            </svg>

            <span class="text-xs font-medium">Riwayat</span>
        </a>

    </div>

</div>