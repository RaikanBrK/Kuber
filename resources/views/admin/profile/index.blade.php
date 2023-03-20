@extends('adminlte::page')

@section('title', __('kuber::admin/profile/index.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/profile/index.title_pag', ['name' => $administrator->name]) }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.profile.store', $administrator->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $administrator->id }}">
            <x-kuber-card :title="__('kuber::admin/profile/index.title_card')" send="save">
                <div class="form-row mb-2">
                    <div class="col-12 col-sm-auto pr-sm-4">
                        <div class="form-group">
                            <label for="campoImageProfile" id="labelImageProfile"
                                class="d-flex flex-column align-items-center">
                                <img src="{{ asset($administrator->image()) }}" alt="{{ $administrator->name }}" class="img-fluid"
                                    id="imageProfile" accept=".png, .jpg, .jpeg">
                                <small class="text-muted">{{ __('kuber::admin/profile/index.label_image') }}</small>
                            </label>
                            <input type="file" class="d-none" id="campoImageProfile" name="image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="name">{{ __('kuber::admin/profile/index.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ $administrator->name }}" value="{{ $administrator->name }}">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="email">{{ __('kuber::admin/profile/index.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{ $administrator->email }}" value="{{ $administrator->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">{{ __('kuber::admin/profile/index.desc') }}</label>
                            <input type="text" class="form-control" id="desc" name="desc"
                                placeholder="{{ $administrator->desc() }}" value="{{ $administrator->desc() }}">
                        </div>
                    </div>
                </div>
            </x-kuber-card>
        </form>
    </div>
@stop

@push('js')
@endpush