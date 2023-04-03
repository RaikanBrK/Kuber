@extends('kuber::admin.auth.layout')

@section('title', __('kuber::admin/auth/login.title'))

@section('description', __('kuber::admin/auth/login.description'))

@section('body')
    <div id="box-content">
        <div class="container-fluid">
            <div class="row position-relative">
                <div class="col-lg-6 d-none d-lg-block col-separator">
                    <img src="{{ asset('vendor/kuber/images/auth_login.png') }}"
                        alt="{{ __('kuber::admin/auth/login.image_auth_alt') }}" class="img-fluid image-auth">
                </div>
                <div class="col-lg-6 col-form">
                    <div class="card-form">
                        <h1 class="title-auth pb-3">{{ __('kuber::admin/auth/login.title_auth') }}</h1>

                        <x-kuber-alert-errors />

                        <form action="{{ route('admin.login.store') }}" method="post" class="mt-4">
                            @csrf
                            <x-kuber-input-rounded type="email" name="email"
                                label="{{ __('kuber::admin/auth/auth.email.label') }}"
                                placeholder="{{ __('kuber::admin/auth/auth.email.placeholder') }}"
                                description="{{ __('kuber::admin/auth/auth.email.description') }}" icon="user" />
                                
                            <x-kuber-input-rounded type="password" name="password"
                                label="{{ __('kuber::admin/auth/auth.password.label') }}"
                                placeholder="{{ __('kuber::admin/auth/auth.password.placeholder') }}"
                                description="{{ __('kuber::admin/auth/auth.password.description') }}" icon="lock"
                                formGroup="mt-4" />

                            <x-kuber-button-rounded text="{{ __('kuber::admin/auth/login.sign_in') }}" />
                        </form>

                        <a href="{{ route('admin.forgot-password') }}"
                            class="text-muted text-center d-block mt-2">{{ __('kuber::admin/auth/login.forgot_password') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
