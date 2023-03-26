@extends('adminlte::page')

@section('title', __('kuber::admin/tags/index.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/tags/index.title') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.settings.tags.store') }}" method="post">
            @csrf
        
            <x-kuber-card :title="__('kuber::admin/tags/index.title')" send="save">
                <x-adminlte-textarea name="head" :label="__('kuber::admin/tags/index.head.label')" :placeholder="__('kuber::admin/tags/index.head.placeholder')" rows="5">
                    {{ $settings->head }}
                </x-adminlte-textarea>

                <x-adminlte-textarea name="body" :label="__('kuber::admin/tags/index.body.label')" :placeholder="__('kuber::admin/tags/index.body.placeholder')" rows="5">
                    {{ $settings->body }}
                </x-adminlte-textarea>
            </x-kuber-card>
        </form>

        <x-adminlte-alert theme="warning" :title="__('kuber::admin/tags/index.title_alert')" >
            {{ __('kuber::admin/tags/index.message_alert', ['name' => auth()->guard('admin')->user()->name]) }}
        </x-adminlte-alert>        
    </div>
@stop
