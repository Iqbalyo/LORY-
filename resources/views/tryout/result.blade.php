<x-app-layout>
    <div class="max-w-md mx-auto p-6 text-center">

       
        <h1 class="text-xl font-bold mb-2">
            Hasil Tryout
        </h1>


        <p class="text-sm text-gray-600">
            Total Soal: {{ $totalQuestions }}
        </p>

        <p class="text-lg font-semibold mt-2">
            Skor Akhir: {{ $tryout->score }}
        </p>

       
        @if ($tryout->is_passed)
            <div class="mt-4 p-3 rounded bg-green-100 text-green-700 font-bold">
                LULUS
            </div>
        @else
            <div class="mt-4 p-3 rounded bg-red-100 text-red-700 font-bold">
                BELUM LULUS
            </div>
        @endif

        <div class="mt-6">
            <h3 class="text-sm font-semibold mb-2">
                Analisa Skor
            </h3>

            <canvas id="scoreChart" height="160"></canvas>
        </div>

       
        <div class="mt-6 space-y-2">
            <a href="{{ route('tryout.history') }}"
               class="block w-full px-4 py-2 bg-gray-200 rounded text-sm">
                Lihat Riwayat Tryout
            </a>

            <a href="{{ route('tryout.start') }}"
               class="block w-full px-4 py-2 bg-blue-600 text-white rounded text-sm">
                Mulai Tryout Baru
            </a>

            <a href="{{ route('dashboard') }}"
               class="block w-full px-4 py-2 bg-[#9A27E6] text-white rounded-2xl text-sm">
                Kembali Ke Beranda
            </a>
        </div>

    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('scoreChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['TWK', 'TIU', 'TKP'],
                datasets: [{
                    data: [
                        {{ $tryout->score_twk }},
                        {{ $tryout->score_tiu }},
                        {{ $tryout->score_tkp }}
                    ],
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#f6c23e'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
