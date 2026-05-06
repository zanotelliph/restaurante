@extends('layout')

@section('conteudo')
<div class="page-header mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1>Pagamentos</h1>
        <p class="text-muted">Registre e visualize pagamentos relacionados aos pedidos.</p>
    </div>
    <div>
        <a href="{{ route('pagamento.create') }}" class="btn btn-primary">Novo Pagamento</a>
    </div>
</div>

<div class="mb-4">
    <form method="GET" action="{{ route('pagamento.index') }}" class="row g-2 align-items-center">
        <div class="col-auto">
            <input type="text" name="search" class="form-control" placeholder="Buscar por cliente ou email" value="{{ $search ?? '' }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
        @if(!empty($search))
            <div class="col-auto">
                <a href="{{ route('pagamento.index') }}" class="btn btn-outline-secondary">Limpar</a>
            </div>
        @endif
    </form>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>Método</th>
                        <th>Status</th>
                        <th>Pago em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pagamentos as $pagamento)
                        <tr>
                            <td>#{{ $pagamento->pedido->id ?? '-' }}</td>
                            <td>{{ $pagamento->pedido->cliente->nome ?? 'Sem cliente' }}</td>
                            <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                            <td>{{ ucfirst($pagamento->metodo) }}</td>
                            <td>{{ ucfirst($pagamento->status) }}</td>
                            <td>{{ $pagamento->pago_em ? $pagamento->pago_em->format('d/m/Y H:i') : '-' }}</td>
                            <td>
                                <a href="{{ route('pagamento.edit', $pagamento->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form method="POST" action="{{ route('pagamento.destroy', $pagamento->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir este pagamento?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Nenhum pagamento registrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
