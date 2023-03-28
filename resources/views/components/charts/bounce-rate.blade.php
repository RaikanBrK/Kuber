<div>
    <canvas id="{{ $id }}"></canvas>
</div>

@once
    @push('js')
        <script src="{{ asset('vendor/kuber/js/chart/chart.js') }}"></script>
    @endpush
@endonce

@push('js')
<script>
    var ctxBounceRate = document.querySelector('#{{ $id }}');
    var data = [{{ implode(" ,", $bounceRate) }}];
    var labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
        'Outubro', 'Novembro', 'Dezembro'];
    var label = 'Taxa de rejeição';
    var text = "Taxa de rejeição por ano";
    var backgroundColor = "#cc65fe";
    var borderColor = "#cc65fe";
</script>

<script>
    new Chart(ctxBounceRate, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderWidth: 2,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    pointStyle: 'circle',
                    pointRadius: 2,
                    pointHoverRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: text,
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
</script>
@endpush