@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <x-adminlte-small-box :title="$visits" text="Visitas no mês" icon="fas fa-eye text-dark" theme="teal"
                    url="#" url-text="Ver detalhes" />
            </div>
            <div class="col-md-6 col-xl-4">
                <x-adminlte-small-box :title="$bounceRate" text="Taxa de rejeição no mês" icon="fas fa-chart-bar text-dark"
                    theme="info" url="#" url-text="Ver detalhes" />
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-columns" style="column-count: 2">
            <x-kuber-card title="Visitas de {{ date('Y') }}" theme="purple" collapsible removable maximizable>
                <div>
                    <canvas id="visitsYear"></canvas>
                </div>
            </x-kuber-card>


            <x-kuber-card title="Taxa de rejeição de {{ date('Y') }}" theme="dark" collapsible removable maximizable>
                <div>
                    <canvas id="bounceRateYear"></canvas>
                </div>
            </x-kuber-card>

            <x-kuber-card title="Navegadores dos usuários" theme="info" collapsible removable maximizable>
                <div style="max-height: 400px" class="d-flex justify-content-center align-items-center">
                    <canvas id="browsersUser"></canvas>
                </div>
            </x-kuber-card>

        </div>
    </div>


@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('visitsYear');
        const ctxBrowser = document.getElementById('browsersUser');
        const ctxBounceRate = document.getElementById('bounceRateYear');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                    'Outubro', 'Novembro', 'Dezembro'
                ],
                datasets: [{
                    label: 'Visitas',
                    data: [{{ $visitsYearCurrent }}],
                    borderWidth: 1,
                    backgroundColor: "#cc65fe",
                }]
            },
            options: {
                plugins: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Visitas por mês"
                    },
                    legend: {
                        display: false
                    },
                },
                scales: {
                    y: {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                        }
                    }
                }
            },
        });

        new Chart(ctxBounceRate, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                    'Outubro', 'Novembro', 'Dezembro'
                ],
                datasets: [{
                    label: 'Taxa de rejeição',
                    data: [100, 20, 75, 38, 94],
                    borderWidth: 2,
                    backgroundColor: "#cc65fe",
                    borderColor: "#cc65fe",
                    pointStyle: 'circle',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Taxa de rejeição por ano'
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label;
                                let value = context.formattedValue || 0;
                                return label + ': ' + value + '%';
                            }
                        }
                    },
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20,
                            callback: function(value, index, values) {
                                return value + '%';
                            }
                        }
                    },
                },  
            },
        });

        new Chart(ctxBrowser, {
            type: 'pie',
            data: {
                labels: ['Chrome', 'Opera', 'Firefox', 'Safari', 'Edge'],
                datasets: [{
                    data: [0, 2, 3, 4, 5],
                    borderWidth: 1,
                }]
            },
            options: {
                plugins: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Navegador usados no trimestre (janeiro até março)"
                    },
                },
                scales: {
                    y: {
                        display: false,
                    }
                }
            },
        });
    </script>

@stop
