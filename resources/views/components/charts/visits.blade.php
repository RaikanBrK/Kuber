<div>
    <canvas id="{{ $id }}"></canvas>
</div>

@push('js')
<script>
    var id = "#{{ $id }}";
    var data = [{{ implode(" ,", $visits) }}];
    var labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
        'Outubro', 'Novembro', 'Dezembro'];
    var label = 'Visitas';
    var text = "Visitas por mês";
    var backgroundColor = "#cc65fe";
</script>

<script src="{{ asset('vendor/kuber/js/components/charts/visits.js') }}"></script>
@endpush