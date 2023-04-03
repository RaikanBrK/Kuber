<x-mail::message>
# Olá, {{ $name }}
 
Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.

<x-mail::button :url="$url">
Redefiner Senha
</x-mail::button>

Este link de redefinição de senha expirará em 60 minutos.

Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.

Atenciosamente,<br>
{{ config('app.name') }}

<hr><br>

Se você estiver tendo problemas ao clicar no botão "Redefinir senha", copie e cole a URL abaixo em seu navegador da web: <a href="{{ $url }}">{{ $url }}</a>
</x-mail::message>