@extends('kuber::admin.auth.layout')

@section('title', __('kuber::admin/auth/reset-password.title'))

@section('description', __('kuber::admin/auth/reset-password.description'))

@section('body')
<div id="box-content" class="one-column">
    <div class="container-fluid">
        <div class="card-form">
            <h1 class="title-auth mb-3">{{ __('kuber::admin/auth/reset-password.title_auth') }}</h1>

            <x-kuber-alert />
    
            <form action="{{ route('admin.reset-password.store') }}" method="post" class="pt-3">
                @csrf
                
                <x-kuber-input-rounded type="email" name="email" label="{{ __('kuber::admin/auth/reset-password.email.label') }}" placeholder="{{ __('kuber::admin/auth/reset-password.email.placeholder') }}" description="{{ __('kuber::admin/auth/reset-password.email.description') }}" icon="user" value="{{ $email }}" />

                <x-kuber-input-rounded type="password" name="password" label="{{ __('kuber::admin/auth/reset-password.password.label') }}" placeholder="{{ __('kuber::admin/auth/reset-password.password.placeholder') }}" description="{{ __('kuber::admin/auth/reset-password.password.description') }}" icon="unlock-alt" formGroup="mt-4" />

                <x-kuber-input-rounded type="password" name="password_confirmation" label="{{ __('kuber::admin/auth/reset-password.password_confirm.label') }}" placeholder="{{ __('kuber::admin/auth/reset-password.password_confirm.placeholder') }}" description="{{ __('kuber::admin/auth/reset-password.password_confirm.description') }}" icon="lock" formGroup="mt-4" />

                <input type="hidden" name="token" value="{{ $token }}">

                <x-kuber-button-rounded text="{{ __('kuber::admin/auth/reset-password.save') }}" />
            </form>
        </div>
    </div>
</div>
@endsection