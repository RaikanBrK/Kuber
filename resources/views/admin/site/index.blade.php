@extends('adminlte::page')

@section('title', __('kuber::admin/site/index.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/site/index.title') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.settings.site.store') }}" method="POST">
            @csrf
            <x-kuber-card :title="__('kuber::admin/site/index.title_card')" send="save">
                <x-kuber-input type="text" name="title" placeholder="{{ $settings->title }}" value="{{ $settings->title }}" />
                <x-kuber-input type="text" name="description" placeholder="{{ $settings->description }}" value="{{ $settings->description }}" />
            </x-kuber-card>
        </form>
    </div>
@stop
