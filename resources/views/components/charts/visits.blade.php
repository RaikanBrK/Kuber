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
    var ctxVisits = document.querySelector('#{{ $id }}');
    var data = [{{ implode(" ,", $visits) }}];
    var labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
        'Outubro', 'Novembro', 'Dezembro'];
    var label = 'Visitas';
    var text = "Visitas por mês";
    var backgroundColor = "#cc65fe";
</script>

<script src="{{ asset('vendor/kuber/js/components/charts/visits.js') }}"></script>

@endpush