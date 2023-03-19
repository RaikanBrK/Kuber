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
                    <div class="form-group col-sm-6">
                        <label for="name">{{ __('kuber::admin/administrators/create.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">{{ __('kuber::admin/administrators/create.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-5 col-md-4">
                        <label for="password">{{ __('kuber::admin/administrators/create.password') }}</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group col-sm-5 col-md-4">
                        <label for="password_confirmation">{{ __('kuber::admin/administrators/create.password_confirm') }}</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                <small class="text-muted">{{ __('kuber::admin/administrators/create.help_info') }}</small>
            </x-kuber-card>
        </form>
    </div>
@stop
