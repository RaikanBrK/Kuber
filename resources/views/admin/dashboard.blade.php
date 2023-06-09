@extends('adminlte::page')

@section('title', __('kuber::admin/dashboard.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/dashboard.title') }}</h1>
@stop

@php
    $routeBounceRate = Route::has('admin.reports.bounce-rate');
    $routeBrowsers = Route::has('admin.reports.browsers');
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <x-adminlte-small-box :title="$visits" :text="__('kuber::admin/dashboard.visits_text')" icon="fas fa-eye text-dark" theme="teal"
                    url="{{ route('admin.reports.visits') }}" :url-text="__('kuber::admin/dashboard.url_text')" />
            </div>
            @if($routeBounceRate)
            <div class="col-md-6 col-xl-4">
                <x-adminlte-small-box :title="$bounceRate" :text="__('kuber::admin/dashboard.bounce_rate_text')" icon="fas fa-chart-bar text-dark"
                    theme="info" url="{{ route('admin.reports.bounce-rate') }}" :url-text="__('kuber::admin/dashboard.url_text')" />
            </div>
            @endif
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-columns" style="column-count: 2">
            <x-kuber-card :title="__('kuber::admin/dashboard.charts.visits', ['year' => date('Y')])" theme="purple" collapsible removable maximizable>
                <x-kuber-charts-visits :visits="$visitsYearCurrent" />
            </x-kuber-card>

            @if ($routeBounceRate)
            <x-kuber-card :title="__('kuber::admin/dashboard.charts.bounce_rate', ['year' => date('Y')])" theme="dark" collapsible removable maximizable>
                <x-kuber-charts-bounce-rate :bounceRate="$bounceRateYearCurrent" />
            </x-kuber-card>
            @endif

            @if ($routeBrowsers)
            <x-kuber-card :title="__('kuber::admin/dashboard.charts.browser')" theme="info" collapsible removable maximizable>
                <x-kuber-charts-browsers :browsers="$browsersQuarterCurrent" />
            </x-kuber-card>
            @endif
        </div>
    </div>
@stop

@push('support_js')
    <script src="{{ asset('vendor/kuber/js/chart/chart.js') }}"></script>
@endpush