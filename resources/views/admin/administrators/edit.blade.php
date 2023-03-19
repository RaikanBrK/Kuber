@extends('adminlte::page')

@section('title', __('kuber::admin/administrators/edit.title', ['name' => $administrator->name]))

@section('content_header')
    <h1>{{ __('kuber::admin/administrators/edit.title', ['name' => $administrator->name]) }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.administrators.update', $administrator) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $administrator->id }}">
            <x-kuber-card title="{{ __('kuber::admin/administrators/edit.title', ['name' => $administrator->name]) }}" send="save" back="admin.administrators.index">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">{{ __('kuber::admin/administrators/edit.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $administrator->name }}" placeholder="{{ $administrator->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">{{ __('kuber::admin/administrators/edit.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $administrator->email }}" placeholder="{{ $administrator->email }}">
                    </div>
                </div>
            </x-kuber-card>
        </form>
    </div>
@stop
