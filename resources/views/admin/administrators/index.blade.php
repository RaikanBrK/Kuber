@extends('adminlte::page')

@section('title', __('kuber::admin/administrators/index.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/administrators/index.title') }}</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <x-adminlte-card :title="__('kuber::admin/administrators/index.title')" theme="lightblue">
            <x-kuber-datatables :head="$head" :items="$users" action :exceptActions="['viewer']" image />
        </x-adminlte-card>
    </div>
@endsection
