<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">

        <h1 class="text-xl font-bold mb-4">
            Riwayat Tryout
        </h1>

        @forelse ($tryouts as $tryout)
            <div class="border rounded-2xl p-4 mb-3 bg-white ">

                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">
                        {{ $tryout->created_at->format('d M Y H:i') }}
                    </span>

                    @if ($tryout->is_passed)
                        <span class="text-green-600 font-semibold">
                            LULUS
                        </span>
                    @else
                        <span class="text-red-600 font-semibold">
                            TIDAK LULUS
                        </span>
                    @endif
                </div>

                <div class="mt-2 text-sm">
                    <p>TWK : {{ $tryout->score_twk }}</p>
                    <p>TIU : {{ $tryout->score_tiu }}</p>
                    <p>TKP : {{ $tryout->score_tkp }}</p>
                    <p class="font-semibold mt-1">
                        Total : {{ $tryout->score }}
                    </p>
                    <p>ID: {{ $tryout->id }}</p>
                </div>

                <a href="{{ route('tryout.result', $tryout) }}"
                   class="text-blue-600 text-sm mt-2 inline-block">
                    Lihat Detail
                </a>

            </div>
        @empty
            <p class="text-gray-500">
                Belum ada tryout.
            </p>
        @endforelse
   {{-- Component navigation bottom --}}
        <x-bottom-nav/>
    </div>
</x-app-layout>
    