@extends('layout')

@section('conteudo')

<div class="page-header">
    <div>
        <h1>Clientes</h1>
        <p class="text-muted">Gerencie os clientes cadastrados e atualize seus dados.</p>
    </div>
    <div class="action-bar">
        <form method="GET" action="{{ route('cliente.index') }}" class="d-flex gap-2 align-items-center">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por nome, email ou CPF" />
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        <a href="{{ route('cliente.create') }}" class="btn btn-success">+ Novo Cliente</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Lista de clientes</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>
                                @php
                                    $clienteImageUrl = null;
                                    if ($cliente->imagem) {
                                        if (preg_match('/^(http|https):\/\//', $cliente->imagem)) {
                                            $clienteImageUrl = $cliente->imagem;
                                        } elseif (file_exists(public_path('storage/'.$cliente->imagem))) {
                                            $clienteImageUrl = asset('storage/'.$cliente->imagem);
                                        } elseif (file_exists(public_path($cliente->imagem))) {
                                            $clienteImageUrl = asset($cliente->imagem);
                                        }
                                    }
                                @endphp
                                @if($clienteImageUrl)
                                    <img src="{{ $clienteImageUrl }}" alt="{{ $cliente->nome }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <div style="height: 40px; width: 40px; border-radius: 50%; background: #ddd; display: flex; align-items: center; justify-content: center;">
                                        <span style="font-size: 10px; color: #999;">-</span>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $cliente->id }}</td>
                            <td class="fw-semibold">{{ $cliente->nome }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>
                                <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                                <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar este cliente?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Nenhum cliente encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $clientes->links() }}
        </div>
    </div>
</div>

@endsection
