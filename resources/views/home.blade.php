@extends('layout')

@section('conteudo')

<div class="text-center mb-5">
    <h1 class="text-5xl font-bold mb-3" style="color: var(--primary-blue);">
        🍽 {{ config('restaurant.name') }}
    </h1>

    <p class="text-2xl mb-4" style="color: var(--secondary-blue);">
        {{ config('restaurant.tagline') }}
    </p>

    <p class="text-lg text-gray-700 mb-3">
        Bem-vindo ao {{ config('restaurant.name') }}.
    </p>

    <p class="text-gray-600">
        <i class="fas fa-phone"></i> {{ config('restaurant.phone') }} | 
        <i class="fas fa-envelope"></i> {{ config('restaurant.email') }}
    </p>
</div>

@endsection