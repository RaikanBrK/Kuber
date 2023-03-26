@extends('adminlte::page')

@section('title', __('kuber::admin/administrators/create.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/administrators/create.title') }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.administrators.store') }}" method="post">
            @csrf
            <x-kuber-card :title="__('kuber::admin/administrators/create.title_card')" send="create">
                <div class="form-row">
                    <x-kuber-input type="text" name="name" formGroupClass="col-sm-6" />
                    <x-kuber-input type="email" formGroupClass="col-sm-6" />
                </div>
                <div class="form-row">
                    <x-kuber-input type="password" formGroupClass="col-sm-5 col-md-4" />
                    <x-kuber-input type="password" name="password_confirmation" formGroupClass="col-sm-5 col-md-4" />
                </div>
                <small class="text-muted">{{ __('kuber::admin/administrators/create.help_info') }}</small>
            </x-kuber-card>
        </form>
    </div>
@stop
