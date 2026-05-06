@extends('layout')

@section('conteudo')

<div class="page-header">
    <div>
        <h1>Pedidos</h1>
        <p class="text-muted">Controle de pedidos e acompanhe o status de cada solicitação.</p>
    </div>
    <div class="action-bar">
        <form method="GET" action="{{ route('pedido.index') }}" class="d-flex gap-2 align-items-center">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por cliente" />
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        <a href="{{ route('pedido.create') }}" class="btn btn-success">+ Novo Pedido</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Itens</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidos as $pedido)
                        <tr>
                            <td><strong>#{{ $pedido->id }}</strong></td>
                            <td>{{ $pedido->cliente?->nome ?? 'N/A' }}</td>
                            <td>
                                @foreach($pedido->itens as $item)
                                    <span class="badge bg-info">
                                        {{ $item->prato?->nome ?? $item->bebida?->nome }} ({{ $item->quantidade }}x)
                                    </span>
                                @endforeach
                            </td>
                            <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                            <td>
                                <span class="badge 
                                    @if($pedido->status === 'pendente') bg-warning
                                    @elseif($pedido->status === 'confirmado') bg-info
                                    @elseif($pedido->status === 'entregue') bg-success
                                    @else bg-danger
                                    @endif
                                ">
                                    {{ ucfirst($pedido->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('pedido.edit', $pedido->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                                <form action="{{ route('pedido.destroy', $pedido->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Nenhum pedido encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Voltar</a>
</div>

@endsection
