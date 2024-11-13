<div>
    @push('css')
        {{-- <link href="{{ asset('limitless/') }}/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css"> --}}
        <link href="{{ asset('limitless/') }}/global_assets/css/icons/material/icons.css" rel="stylesheet" type="text/css">
    @endpush
    <x-slot name="header">
        <livewire:admin.global.page-header judul="Dashboard" subjudul="Quick Qount TPS Kab. Wonosobo" :breadcrumb="['Quick Qount TPS Kab. Wonosobo']" />
    </x-slot>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Rekap Total Quick Count Calon Bupati dan Wakil Bupati</h6>
                    <div class="header-elements">
                        <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                            <label class="form-check-label">
                                Live update:

                            </label>
                            <a href="{{ route('dashboard-tps') }}" wire:navigate><i
                                    class="mi-refresh mr-3 mi-1x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="display: flex; justify-content: space-around;">
                        <div class="text-center">
                            <h3>Calon Bupati dan Wakil Bupati</h3>
                            <canvas id="bupatiPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Rekap Total Quick Count calon Gubernur dan Wakil Gubernur</h6>
                    <div class="header-elements">
                        <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                            <label class="form-check-label">
                                Live update:

                            </label>
                            <a href="{{ route('dashboard-tps') }}"><i class="mi-refresh mr-3 mi-1x"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div style="display: flex; justify-content: space-around;">
                        <div class="text-center">
                            <h3>Calon Gubernur dan Wakil Gubernur</h3>
                            <canvas id="gubernurPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Traffic Pemilihan Calon Bupati dan Wakil Bupati Berdasarkan Kecamatan</h6>
                    <div class="header-elements">
                        <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                            <label class="form-check-label">
                                Live update:

                            </label>
                            <a href="{{ route('dashboard-tps') }}"><i class="mi-refresh mr-3 mi-1x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="row">
                        <canvas id="bupatiChart"></canvas>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Traffic Pemilihan Calon Gurbernur dan Wakil Gubernur Berdasarkan Kecamatan
                    </h6>
                    <div class="header-elements">
                        <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                            <label class="form-check-label">
                                Live update:
                            </label>
                            <a href="{{ route('dashboard-tps') }}"><i class="mi-refresh mr-3 mi-1x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="row">
                        <canvas id="gubernurChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:admin.pages.filtering-kecamatan>
        @push('js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                document.addEventListener('livewire:load', function() {
                    // Pie chart untuk Gubernur
                    var ctxGubernur = document.getElementById('gubernurPieChart').getContext('2d');
                    var gubernurPieChart = new Chart(ctxGubernur, {
                        type: 'pie',
                        data: {
                            labels: ['No. 1 Andika & Hendi', 'No. 2 Luthfi & Taj Yasin', 'Tidak Sah'],
                            datasets: [{
                                label: 'Gubernur',
                                data: @json($gubernur),
                                backgroundColor: [
                                    'rgba(217, 4, 15, 0.8)',
                                    'rgba(0, 56, 184, 0.8)',
                                    'rgba(0, 0, 0, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(217, 4, 15, 0.8)',
                                    'rgba(0, 56, 184, 0.8)',
                                    'rgba(0, 0, 0, 0.5)'
                                ],
                                borderWidth: 1
                            }]
                        }
                    });

                    // Pie chart untuk Bupati
                    var ctxBupati = document.getElementById('bupatiPieChart').getContext('2d');
                    var bupatiPieChart = new Chart(ctxBupati, {
                        type: 'pie',
                        data: {
                            labels: ['No. 1 Afif dan Amir', 'No. 2 Khairullah dan Sidqi', 'Tidak Sah'],
                            datasets: [{
                                label: 'Bupati',
                                data: @json($bupati),
                                backgroundColor: [
                                    'rgba(217, 4, 15, 0.8)',
                                    'rgba(4, 160, 22, 0.8)',
                                    'rgba(0, 0, 0, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(217, 4, 15, 0.8)',
                                    'rgba(4, 160, 22, 0.8)',
                                    'rgba(0, 0, 0, 0.5)'
                                ],
                                borderWidth: 1
                            }]
                        }
                    });

                    //barchart bupati
                    var ctx = document.getElementById('bupatiChart').getContext('2d');
                    var chartData = @json($chartBupati);

                    var labels = chartData.map(item => item.region);
                    var b1Data = chartData.map(item => item.total_b1);
                    var b2Data = chartData.map(item => item.total_b2);
                    var btsData = chartData.map(item => item.total_bts);

                    var kecamatanChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'No. 1 Afif dan Amir',
                                    data: b1Data,
                                    backgroundColor: 'rgba(217, 4, 15, 0.8)',
                                    borderColor: 'rgba(217, 4, 15, 0.8)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'No. 2 Khairullah dan Sidqi',
                                    data: b2Data,
                                    backgroundColor: 'rgba(4, 160, 22, 0.8)',
                                    borderColor: 'rgba(4, 160, 22, 0.8)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Tidak Sah',
                                    data: btsData,
                                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
                                    borderColor: 'rgba(0, 0, 0, 0.5)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    //barchart Gurbernur
                    var ctx = document.getElementById('gubernurChart').getContext('2d');
                    var chartData = @json($chartGurbernur);
                    console.log(chartData);
                    var labels = chartData.map(item => item.region);
                    var g1Data = chartData.map(item => item.total_g1);
                    var g2Data = chartData.map(item => item.total_g2);
                    var gtsData = chartData.map(item => item.total_gts);

                    var kecamatanChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'No. 1 Andika & Hendi',
                                    data: g1Data,
                                    backgroundColor: 'rgba(217, 4, 15, 0.8)',
                                    borderColor: 'rgba(217, 4, 15, 0.8)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'No. 2 Luthfi & Taj Yasin',
                                    data: g2Data,
                                    backgroundColor: 'rgba(0, 56, 184, 0.8)',
                                    borderColor: 'rgba(0, 56, 184, 0.8)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Tidak Sah',
                                    data: gtsData,
                                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
                                    borderColor: 'rgba(0, 0, 0, 0.5)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>
        @endpush
</div>
