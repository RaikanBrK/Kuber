@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <x-adminlte-small-box :title="$visits" text="Visitas no mês" icon="fas fa-eye text-dark" theme="teal"
                    url="#" url-text="Ver detalhes" />
            </div>
            <div class="col-md-6 col-xl-4">
                <x-adminlte-small-box :title="$bounceRate" text="Taxa de rejeição no mês" icon="fas fa-chart-bar text-dark"
                    theme="info" url="#" url-text="Ver detalhes" />
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-columns" style="column-count: 2">
            <x-kuber-card title="Visitas de {{ date('Y') }}" theme="purple" collapsible removable maximizable>
                <x-kuber-charts-visits :visits="$visitsYearCurrent" />
            </x-kuber-card>

            <x-kuber-card title="Taxa de rejeição de {{ date('Y') }}" theme="dark" collapsible removable maximizable>
                <x-kuber-charts-bounce-rate :bounceRate="$bounceRateYearCurrent" />
            </x-kuber-card>

            <x-kuber-card title="Navegadores dos usuários" theme="info" collapsible removable maximizable>
                <x-kuber-charts-browsers :browsers="$browsersYearCurrent" />
            </x-kuber-card>

        </div>
    </div>


@stop
