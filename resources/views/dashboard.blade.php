@extends('layout')

@section('conteudo')
<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-4">🍽️ Bem-vindo ao BigHouse</h1>
            <p class="text-muted">Gerenciamento completo de clientes, pedidos e estoque</p>
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
                    <h2>📋</h2>
                    <h3 class="card-title">Pedidos</h3>
                    <p class="card-text display-6">{{ $pedidosCount }}</p>
                    <a href="{{ route('pedido.index') }}" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>📦</h2>
                    <h3 class="card-title">Estoque</h3>
                    <p class="card-text display-6">{{ $estoqueCount }}</p>
                    <a href="{{ route('estoque.index') }}" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>📅</h2>
                    <h3 class="card-title">Reservas</h3>
                    <p class="card-text display-6">{{ $reservasCount }}</p>
                    <a href="{{ route('reserva.index') }}" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>💳</h2>
                    <h3 class="card-title">Pagamentos</h3>
                    <p class="card-text display-6">{{ $pagamentosCount }}</p>
                    <a href="{{ route('pagamento.index') }}" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>📊</h2>
                    <h3 class="card-title">Gráficos</h3>
                    <p class="text-muted small">Visualize análises e estatísticas</p>
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('grafico.clientes-pedidos') }}" class="btn btn-outline-primary btn-sm">Barras</a>
                        <a href="{{ route('grafico.pratos-categoria') }}" class="btn btn-outline-primary btn-sm">Pizza</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card dashboard-card bg-light">
                <div class="card-body">
                    <h2>📄</h2>
                    <h3 class="card-title">Relatórios</h3>
                    <p class="text-muted small">Gere relatórios em PDF</p>
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('relatorio.pedidos') }}" class="btn btn-outline-success btn-sm">Pedidos</a>
                        <a href="{{ route('relatorio.clientes') }}" class="btn btn-outline-success btn-sm">Clientes</a>
                    </div>
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
