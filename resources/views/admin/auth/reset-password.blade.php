@extends('kuber::admin.auth.layout')

@section('title', 'Redefinir senha do usuário administrativo - Painel Administrativo')

@section('description', 'Crie uma nova senha forte e exclusiva para acessar o painel administrativo. Insira a nova senha nos campos abaixo e clique em "Salvar" para concluir o processo de redefinição de senha.')

@section('body')
<div id="box-content" class="one-column">
    <div class="container-fluid">
        <div class="card-form">
            <h1 class="title-auth">Digite sua nova senha</h1>
    
            <form action="#" class="mt-5">
                <x-kuber-input-rounded type="email" name="email" label="Email" placeholder="Email" description="Digite seu email" icon="user" />

                <x-kuber-input-rounded type="password" name="password" label="Senha" placeholder="Nova senha" description="Digite sua senha" icon="unlock-alt" formGroup="mt-4" />

                <x-kuber-input-rounded type="password" name="password_confirmation" label="Confirmar senha" placeholder="Confirme a senha" description="Confirme a senha" icon="lock" formGroup="mt-4" />

                <x-kuber-button-rounded text="Salvar" />
            </form>
        </div>
    </div>
</div>
@endsection