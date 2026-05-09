<x-app-layout>
    <div class="px-6 pt-4 pb-24">
        
        <a href="{{ route('tryout.start')}}">
            <h1 class="text-4xl font-semibold text-[#3A4A5A]">Ayo mulai Tryout <br> Sekarang</h1>

        {{--  --}}
        <div class="mt-6">
            
            <div class="mt-8">
                <div class="bg-white rounded-2xl p-6 leading-tight">
                    <h2 class="text-3xl font-semibold text-[#3A4A5A]">Uji Kemampuan <br>SKD Mu..</h2>
                    <p class="text-[#3A4A5A] mt-2 font-medium">Siap Lulus SKD Tahun ini?</p>
                    <div class="flex justify-between mt-6 items-center">
                        
                        <span class="text-xl font-medium">Mulai Tryout</span>

                          
                <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 text-[#1A2B3E]"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7" />

                </svg>
                    </div>
                </div>
                
            </div>
        </div>
        </a>
        

        {{-- Component navigation bottom --}}
        <x-bottom-nav/>
   

    </div>
</x-app-layout>