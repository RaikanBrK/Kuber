<div style="max-height: 400px" class="d-flex justify-content-center align-items-center">
    <canvas id="{{ $id }}"></canvas>
</div>

@once
    @push('js')
        <script src="{{ asset('vendor/kuber/js/chart/chart.js') }}"></script>
    @endpush
@endonce


@push('js')
<script>
    var ctxBrowser = document.querySelector('#{{ $id }}');
    var data = [{{ implode(" ,", $browsers) }}];
    var labels = [{!! "'" . implode("', '", array_keys($browsers)) . "'" !!}];
    var text = "Navegador usados no trimestre (janeiro até março)";
</script>

<script src="{{ asset('vendor/kuber/js/components/charts/browser.js') }}"></script>
@endpush