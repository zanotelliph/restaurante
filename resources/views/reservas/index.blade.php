@extends('layout')

@section('conteudo')
<div class="page-header mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1>Reservas</h1>
        <p class="text-muted">Gerencie as reservas de clientes e visualize o histórico.</p>
    </div>
    <div>
        <a href="{{ route('reserva.create') }}" class="btn btn-primary">Nova Reserva</a>
    </div>
</div>

<div class="mb-4">
    <form method="GET" action="{{ route('reserva.index') }}" class="row g-2 align-items-center">
        <div class="col-auto">
            <input type="text" name="search" class="form-control" placeholder="Buscar por cliente ou email" value="{{ $search ?? '' }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
        @if(!empty($search))
            <div class="col-auto">
                <a href="{{ route('reserva.index') }}" class="btn btn-outline-secondary">Limpar</a>
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
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Pessoas</th>
                        <th>Status</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->cliente->nome ?? 'Cliente removido' }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->data_reserva)->format('d/m/Y') }}</td>
                            <td>{{ substr($reserva->hora_reserva, 0, 5) }}</td>
                            <td>{{ $reserva->pessoas }}</td>
                            <td>{{ ucfirst($reserva->status) }}</td>
                            <td>{{ Str::limit($reserva->observacoes, 50) }}</td>
                            <td>
                                <a href="{{ route('reserva.edit', $reserva->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form method="POST" action="{{ route('reserva.destroy', $reserva->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja mesmo excluir esta reserva?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Nenhuma reserva encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
