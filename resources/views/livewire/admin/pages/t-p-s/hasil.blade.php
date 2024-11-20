<div>
    <div>
        <h2>Chart Gubernur</h2>
        <canvas id="chartGubernur"></canvas>

        <h2>Chart Bupati</h2>
        <canvas id="chartBupati"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            let chartGubernur = null;
            let chartBupati = null;

            function renderChart(chartId, data, chartObj) {
                const ctx = document.getElementById(chartId).getContext('2d');
                if (chartObj) chartObj.destroy(); // Hapus chart sebelumnya

                return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => item.region),
                        datasets: [{
                                label: 'G1',
                                data: data.map(item => item.total_g1 || item.total_b1),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'G2',
                                data: data.map(item => item.total_g2 || item.total_b2),
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'GTS',
                                data: data.map(item => item.total_gts || item.total_bts),
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                    },
                });
            }

            Livewire.on('refreshChart', (chartGubernurData, chartBupatiData) => {
                chartGubernur = renderChart('chartGubernur', chartGubernurData, chartGubernur);
                chartBupati = renderChart('chartBupati', chartBupatiData, chartBupati);
            });

            // Render pertama kali
            chartGubernur = renderChart('chartGubernur', @json($chartGubernur), chartGubernur);
            chartBupati = renderChart('chartBupati', @json($chartBupati), chartBupati);
        });
    </script>

</div>
