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
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" required name="title" id="title" placeholder="{{ $settings->title }}" value="{{ $settings->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" required name="description" id="description" placeholder="{{ $settings->description }}" value="{{ $settings->description }}">
                </div>
            </x-kuber-card>
        </form>
    </div>
@stop
