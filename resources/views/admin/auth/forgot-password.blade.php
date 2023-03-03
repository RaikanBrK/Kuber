@extends('kuber::admin.auth.layout')

@section('title', 'Recuperação de senha - Painel Administrativo')

@section('description', 'Esqueceu sua senha de acesso ao painel administrativo? Não se preocupe, basta informar o endereço de e-mail cadastrado e enviaremos as instruções para redefinição da senha. Mantenha a segurança dos seus dados com nossa recuperação de senha fácil e confiável.')

@section('body')
<div id="box-content" class="one-column">
    <div class="container-fluid">
        <div class="card-form">
            <h1 class="title-auth">Recupere sua senha</h1>

            <p class="mb-0 mt-3">Se você esqueceu a senha do painel administrativo, não se preocupe, é possível recuperá-la. Basta inserir o seu e-mail cadastrado e seguir as instruções no e-mail que será enviado. Escolha uma senha forte e exclusiva.</p>
    
            <form action="#" class="mt-5">
                <x-kuber-input-rounded type="email" name="email" label="Email" placeholder="admin@xyz.com" description="Digite seu email" icon="user" />
    
                <x-kuber-button-rounded text="Recuperar senha" />
            </form>
    
            <a href="{{ route('admin.login') }}" class="text-muted text-center d-block mt-5">Voltar ao login</a>
        </div>
    </div>
</div>
@endsection