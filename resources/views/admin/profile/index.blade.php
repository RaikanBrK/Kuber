@extends('adminlte::page')

@section('title', __('kuber::admin/profile/index.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/profile/index.title_pag', ['name' => $administrator->name]) }}</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/kuber/css/admin/profile/index.css') }}">
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-kuber-card :title="__('kuber::admin/profile/index.title_card')" send="save">
                <div class="form-row mb-2">
                    <div class="col-12 col-md-auto pr-sm-4">
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
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="desc">{{ __('kuber::admin/profile/index.desc') }}</label>
                                <input type="text" class="form-control" id="desc" name="desc"
                                    placeholder="{{ $administrator->desc() }}" value="{{ $administrator->desc() }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxChangePassword" name="checkBoxChangePassword">
                                    <label class="custom-control-label" for="checkBoxChangePassword">Alterar Senha</label>
                                </div>
                            </div>
                            <div class="form-row col-12 d-none" id="changePassword">
                                <div class="form-group col-md-6">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirmar Senha</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-kuber-card>
        </form>
    </div>
@stop

@push('js')
    <script src="{{ asset('vendor/kuber/js/admin/profile/index.js') }}"></script>
@endpush
