<div>
    <canvas id="{{ $id }}"></canvas>
</div>

@push('js')
<script>
    var id = "#{{ $id }}";
    var data = [{{ implode(", ", $visits) }}];
    var labels = [{!! "'" . implode("', '", __('kuber::components/charts/chart.months')) . "'" !!}];
    var label = "{{ __('kuber::components/charts/visits.label') }}";
    var text = "{{ __('kuber::components/charts/visits.text') }}";
    var backgroundColor = "#cc65fe";
</script>

<script src="{{ asset('vendor/kuber/js/components/charts/visits.js') }}"></script>
@endpush