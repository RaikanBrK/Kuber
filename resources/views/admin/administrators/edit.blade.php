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
                    <x-kuber-input type="text" name="name" formGroupClass="col-md-6" placeholder="{{ $administrator->name }}" value="{{ $administrator->name }}" />
                    <x-kuber-input type="email" formGroupClass="col-md-6" placeholder="{{ $administrator->email }}" value="{{ $administrator->email }}" />
                </div>
            </x-kuber-card>
        </form>
    </div>
@stop
