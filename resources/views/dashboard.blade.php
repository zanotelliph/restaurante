@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-4">🍽️ Bem-vindo ao Sistema de Restaurante</h1>
            <p class="text-muted">Gerenciamento completo de clientes, pratos e bebidas</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>👥</h2>
                    <h3 class="card-title">Clientes</h3>
                    <p class="card-text display-6">{{ $clientesCount }}</p>
                    <a href="{{ route('cliente.index') }}" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>🍴</h2>
                    <h3 class="card-title">Pratos</h3>
                    <p class="card-text display-6">{{ $pratosCount }}</p>
                    <a href="{{ route('prato.index') }}" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>🥤</h2>
                    <h3 class="card-title">Bebidas</h3>
                    <p class="card-text display-6">{{ $bebidasCount }}</p>
                    <a href="{{ route('bebida.index') }}" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="alert alert-info">
                <strong>ℹ️ Informações Úteis:</strong>
                <ul class="mb-0 mt-2">
                    <li>Use o menu superior para acessar cada seção</li>
                    <li>Clique em "Novo" para adicionar um novo item</li>
                    <li>Use "Editar" para modificar informações existentes</li>
                    <li>Clique em "Deletar" para remover um item</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
