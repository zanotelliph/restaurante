@extends('layout')

@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 text-2xl font-bold text-gray-700">
        👤 Pedidos
    </h2>
    <form method="GET" action="{{ route('pedido.index') }}" class="d-flex" style="gap: 0.5rem;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por cliente" />
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    <a href="{{ route('pedido.create') }}" class="btn btn-success">+ Novo Pedido</a>
</div>

<div class="table-responsive">
<table class="table table-hover table-striped">

<thead class="table-dark">
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

@foreach($pedidos as $pedido)

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
    <a href="{{ route('pedido.edit', $pedido->id) }}" class="btn btn-sm btn-warning">Editar</a>
    <form action="{{ route('pedido.destroy', $pedido->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Deletar</button>
    </form>
</td>
</tr>

@endforeach

</tbody>

</table>
</div>

<div class="mt-4">
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Voltar</a>
</div>

@endsection