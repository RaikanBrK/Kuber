@extends('kuber::admin.auth.layout')

@section('title', __('kuber::admin/auth/forgot-password.title'))

@section('description', __('kuber::admin/auth/forgot-password.description'))

@section('body')
<div id="box-content" class="one-column">
    <div class="container-fluid">
        <div class="card-form">
            <h1 class="title-auth">{{ __('kuber::admin/auth/forgot-password.title_auth') }}</h1>

            <p class="mb-0 mt-3">{{ __('kuber::admin/auth/forgot-password.text_help') }}</p>
    
            <form action="{{ route('admin.forgot-password.store') }}" method="post" class="mt-5">
                @csrf
                
                <x-kuber-input-rounded type="email" name="email" label="{{ __('kuber::admin/auth/auth.email.label') }}" placeholder="{{ __('kuber::admin/auth/auth.email.placeholder') }}" description="{{ __('kuber::admin/auth/auth.email.description') }}" icon="user" />
                
                <x-kuber-button-rounded text="{{ __('kuber::admin/auth/forgot-password.recover_password') }}" />
            </form>
    
            <a href="{{ route('admin.login') }}" class="text-muted text-center d-block mt-5">{{ __('kuber::admin/auth/forgot-password.back_login') }}</a>
        </div>
    </div>
</div>
@endsection