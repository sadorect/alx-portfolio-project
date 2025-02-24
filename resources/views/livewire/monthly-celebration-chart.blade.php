<div class="relative" wire:ignore>
  <div class="min-h-[400px] w-full">
    <canvas id="celebrationChart" style="width: 100%; height: 100%;"></canvas>
</div>
    <script>
        document.addEventListener('livewire:load', function() {
            const chartData = @json($monthlyData);
            const ctx = document.getElementById('celebrationChart').getContext('2d');
            
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(chartData),
                    datasets: [
                        {
                            label: 'Birthdays',
                            data: Object.values(chartData).map(item => item.birthdays),
                            backgroundColor: '#9333ea',
                            borderRadius: 4
                        },
                        {
                            label: 'Anniversaries',
                            data: Object.values(chartData).map(item => item.anniversaries),
                            backgroundColor: '#c084fc',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                  }
                }
            });

            Livewire.on('chartDataUpdated', newData => {
                chart.data.datasets[0].data = Object.values(newData).map(item => item.birthdays);
                chart.data.datasets[1].data = Object.values(newData).map(item => item.anniversaries);
                chart.update();
            });
        });
    </script>
</div>
