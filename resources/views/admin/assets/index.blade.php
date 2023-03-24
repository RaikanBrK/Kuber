@extends('adminlte::page')

@section('title', __('kuber::admin/assets/index.title'))

@section('content_header')
    <h1>{{ __('kuber::admin/assets/index.title') }}</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/kuber/css/admin/assets/index.css') }}">
@stop

@section('content')
    <div class="container-fluid" id="logoFaviconCards">

        <form action="{{ route('admin.settings.assets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-kuber-card :title="__('kuber::admin/assets/index.title')" send="save">    
                <x-adminlte-card :title="__('kuber::admin/assets/index.title_card_logo')" theme="lightblue" theme-mode="outline"
                    header-class="text-uppercase rounded-bottom border-info">
                    <div class="row">
                        <div class="col-sm-4 col-md-3 col-lg-2 mb-4 mb-sm-0 content-img">
                            <img src="{{ asset($settings->logo) }}" alt="Logo" class="img-fluid logo" id="imageLogo">
                        </div>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-lightblue">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" name="logo" />
                                    <label class="custom-file-label" for="lgoo">Selecione a logo...</label>
                                </div>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">{{ __('kuber::admin/assets/index.message_help_logo') }}</small>
                        </div>
                    </div>
                </x-adminlte-card>

                <x-adminlte-card :title="__('kuber::admin/assets/index.title_card_favicon')" theme="lightblue" theme-mode="outline"
                    header-class="text-uppercase rounded-bottom border-info">
                    <div class="row">
                        <div class="col-sm-4 col-md-3 col-lg-2 mb-4 mb-sm-0 content-img">
                            <img src="{{ asset($settings->favicon) }}" alt="Favicon" class="img-fluid favicon"
                                id="imageFavicon">
                        </div>
                        <div class="col">

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-lightblue">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="favicon" name="favicon" />
                                    <label class="custom-file-label" for="favicon">Selecione o favicon...</label>
                                </div>
                            </div>

                            <small id="emailHelp" class="form-text text-muted">{{ __('kuber::admin/assets/index.message_help_favicon') }}</small>
                        </div>
                    </div>
                </x-adminlte-card>
            </x-kuber-card>
        </form>


        <x-adminlte-alert theme="light" :title="__('kuber::admin/assets/index.alert.title')" dismissable>
            <p>{{ __('kuber::admin/assets/index.alert.p1') }}</p>

            <p>{{ __('kuber::admin/assets/index.alert.p2') }}</p>
        </x-adminlte-alert>

    </div>
@stop

@section('js')
    <script src="{{ asset('vendor/kuber/js/admin/assets/index.js') }}"></script>
@stop
