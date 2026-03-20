@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Clientes</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('cliente.create') }}" class="btn btn-primary">+ Novo Cliente</a>
        </div>
    </div>

    <!-- Campo de Busca -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="GET" action="{{ route('cliente.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nome, email ou CPF..."
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i> Buscar
                </button>
                @if(request('search'))
                    <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Limpar
                    </a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-end">
            @if(request('search'))
                <small class="text-muted">
                    {{ $clientes->total() }} resultado{{ $clientes->total() != 1 ? 's' : '' }} encontrado{{ $clientes->total() != 1 ? 's' : '' }}
                </small>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($clientes as $cliente)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    @if($cliente->imagem)
                        <img src="{{ asset($cliente->imagem) }}" class="card-img-top" alt="{{ $cliente->nome }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">Sem imagem</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $cliente->nome }}</h5>
                        <p class="card-text">
                            <small><strong>Email:</strong> {{ $cliente->email }}</small><br>
                            <small><strong>CPF:</strong> {{ $cliente->cpf }}</small><br>
                            <small><strong>Telefone:</strong> {{ $cliente->telefone ?? 'N/A' }}</small>
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex gap-2">
                            <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-sm btn-warning flex-grow-1">Editar</a>
                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" style="display:inline; flex-grow: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Tem certeza?')">Deletar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p class="mb-0">Nenhum cliente cadastrado</p>
                    <a href="{{ route('cliente.create') }}" class="btn btn-primary mt-3">Criar primeiro cliente</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    @if($clientes->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $clientes->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
