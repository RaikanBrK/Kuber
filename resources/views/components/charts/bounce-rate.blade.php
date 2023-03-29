<div>
    <canvas id="{{ $id }}"></canvas>
</div>

@push('js')
<script>
    var id = "#{{$id}}";
    var data = [{{ implode(", ", $bounceRate) }}];
    var labels = [{!! "'" . implode("', '", __('kuber::components/charts/chart.months')) . "'" !!}];
    var label = "{{ __('kuber::components/charts/bounce-rate.label') }}";
    var text = "{{ __('kuber::components/charts/bounce-rate.text') }}";
    var backgroundColor = "#cc65fe";
    var borderColor = "#cc65fe";
</script>

<script src="{{ asset('vendor/kuber/js/components/charts/bounce-rate.js') }}"></script>
@endpush