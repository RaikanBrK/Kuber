<div style="max-height: 400px" class="d-flex justify-content-center align-items-center">
    <canvas id="{{ $id }}"></canvas>
</div>

@push('js')
<script>
    var id = "#{{ $id }}";
    var data = [{{ implode(", ", $browsers) }}];
    var labels = [{!! "'" . implode("', '", array_keys($browsers)) . "'" !!}];
    var text = "{{ __('kuber::components/charts/browser.text', [
        'month1' => __('kuber::components/charts/chart.months')[$month1],
        'month2' => __('kuber::components/charts/chart.months')[$month2],
    ]) }}";
</script>

<script src="{{ asset('vendor/kuber/js/components/charts/browser.js') }}"></script>
@endpush