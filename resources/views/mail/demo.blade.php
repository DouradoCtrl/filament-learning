@component('mail::message')
# Olá {{ $user->name }}

{!! $data['message'] !!}

@component('mail::button', ['url' => 'https://seusite.com'])
Clique aqui
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent