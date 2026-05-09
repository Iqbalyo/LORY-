<h3>Analisa Skor</h3>

<canvas id="scoreChart" height="200"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('scoreChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['TWK', 'TIU', 'TKP'],
        datasets: [{
            label: 'Skor',
            data: [
                {{ $tryout->score_twk }},
                {{ $tryout->score_tiu }},
                {{ $tryout->score_tkp }},
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
                display: fals
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
