<div>
    <canvas id="{{ $id }}"></canvas>
</div>

@push('js')
    <script>
        var id = "#{{ $id }}";
        var data = [
            @foreach ($browsers as $browser => $data)
                {
                    label: '{{ __("kuber::components/charts/browser.browsers." . $browser) }}',
                    data: [{{ implode(", ", $data) }}],
                },
            @endforeach
        ];
        var labels = [{!! "'" . implode("', '", __('kuber::components/charts/chart.months')) . "'" !!}];
    </script>

    <script src="{{ asset('vendor/kuber/js/components/charts/browser-bar.js') }}"></script>
@endpush
