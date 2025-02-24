<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">User Growth</h2>
    <div class="min-h-[300px]" wire:ignore>
        <canvas id="userGrowthChart"></canvas>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            const data = @json($monthlyGrowth);
            const ctx = document.getElementById('userGrowthChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.month),
                    datasets: [{
                        label: 'New Users',
                        data: data.map(item => item.total),
                        borderColor: '#9333ea',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
</div>
