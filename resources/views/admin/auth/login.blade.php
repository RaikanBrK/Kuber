@extends('kuber::admin.auth.layout')

@section('title', 'Login Administrativo')

@section('description', 'Acesse a página de login administrativo para gerenciar suas configurações e controlar o acesso aos recursos do seu site. Faça login com segurança e facilidade para garantir a proteção dos seus dados e informações.')

@section('body')
<div id="box-content">
    <div class="container-fluid">
        <div class="row position-relative">
            <div class="col-lg-6 d-none d-lg-block col-separator">
                <img src="{{ asset('vendor/kuber/images/auth_login.png') }}" alt="Faça login como administrador" class="img-fluid image-auth">
            </div>
            <div class="col-lg-6 col-form">
                <div class="card-form">
                    <h1 class="title-auth">Faça login como usuário administrador</h1>
    
                <form action="#" class="mt-5">
                    <x-kuber-input-rounded type="email" name="email" label="Email" placeholder="admin@xyz.com" description="Digite seu email" icon="user" />
                    <x-kuber-input-rounded type="password" name="password" label="Senha" placeholder="x x x x x x x x x" description="Digite sua senha" icon="lock" formGroup="mt-4" />
    
                    <x-kuber-button-rounded text="Logar" />
                </form>
    
                <a href="{{ route('admin.forgot-password') }}" class="text-muted text-center d-block mt-2">Esqueceu sua senha?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection