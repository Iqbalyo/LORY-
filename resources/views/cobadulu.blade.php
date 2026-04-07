<x-guest-layout>
    <!-- Session Status -->

    <style>
        body {
            overflow: hidden;
        }
    </style>
    
    <div class=" min-h-screen p-6 pt-20 relative">
        
        <!-- TOP INFO -->
<div class="absolute top-6 left-6 right-6 flex justify-between z-10">

    <!-- nomor soal -->
    <div class="bg-white/90 backdrop-blur px-4 py-2 rounded-full text-sm font-semibold text-[#1A2B3E] shadow">
        1/40
    </div>

    <!-- timer -->
    <div class="bg-white/90 backdrop-blur px-4 py-2 rounded-full text-sm font-semibold text-red-500 shadow">
        15:00
    </div>

</div>
        <div class="bg-[#1A2B3E] flex-col p-2 min-h-screen rounded-2xl">
            
            <div class="bg-white rounded-2xl p-4 leading-tight">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae doloremque rem dolorem distinctio quis, odio in eligendi accusamus quod maxime fuga, veniam suscipit aspernatur! Iure consectetur laborum similique est ratione!</div>
            <button class="bg-green-300 rounded-xl p-2 mt-2">Kategory</button>

            @php
    $options = ['A', 'B', 'C', 'D', 'E'];
@endphp

<div class="grid gap-4 mt-4">
    @foreach($options as $opt)
        <div class="bg-white hover:bg-blue-50 border border-gray-200 rounded-xl p-4 cursor-pointer transition-all flex items-center shadow-sm group">
            <span class="font-bold mr-3 text-blue-600 group-hover:scale-110 transition-transform">
                {{ $opt }}.
            </span>
            <span class="text-gray-700">Teks jawaban di sini...</span>
        </div>
    @endforeach
</div>
    <!-- NEXT BUTTON -->
<div class="fixed left-0 w-full flex justify-center pt-8">

    <button class="bg-[#1A2B3E] text-white px-6 py-3 rounded-full shadow-lg">
        Soal Berikutnya →
    </button>
        </div>
        
    </div>


</div>
    
</x-guest-layout>
