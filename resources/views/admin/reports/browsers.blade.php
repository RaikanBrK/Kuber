@extends('adminlte::page')

@section('title', __('kuber::admin/reports/browsers.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/reports/browsers.title') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.reports.browsers') }}" method="get">
            <x-kuber-card :title="__('kuber::admin/reports/browsers.title_card')" theme="success" send="save">
                <select class="custom-select" name="year">
                    @for ($i = $yearCurrent; $i > $yearMin; $i--)
                    <option @selected($year == $i)>{{ $i }}</option>
                    @endfor
                </select>
            </x-kuber-card>
        </form>
        <x-kuber-card :title="__('kuber::admin/reports/browsers.title_chart_card', ['year' => $year])" collapsible maximizable>
            <x-kuber-charts-browsers-bar :browsers="$browsersYear" />
        </x-kuber-card>
    </div>
@stop

@push('support_js')
    <script src="{{ asset('vendor/kuber/js/chart/chart.js') }}"></script>
@endpush
