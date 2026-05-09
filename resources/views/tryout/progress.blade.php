<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-4 text-center">
            Progress Tryout
        </h2>

        <canvas id="progressChart" height="200"></canvas>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Skor Tryout',
                    data: @json($scores),
                    borderWidth: 2,
                    tension: 0.3
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
