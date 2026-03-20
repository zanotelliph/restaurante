@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Bebidas</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('bebida.create') }}" class="btn btn-primary">+ Nova Bebida</a>
        </div>
    </div>

    <!-- Campo de Busca -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="GET" action="{{ route('bebida.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nome, descrição ou categoria..."
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i> Buscar
                </button>
                @if(request('search'))
                    <a href="{{ route('bebida.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Limpar
                    </a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-end">
            @if(request('search'))
                <small class="text-muted">
                    {{ $bebidas->total() }} resultado{{ $bebidas->total() != 1 ? 's' : '' }} encontrado{{ $bebidas->total() != 1 ? 's' : '' }}
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
        @forelse($bebidas as $bebida)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    @if($bebida->imagem)
                        <img src="{{ asset($bebida->imagem) }}" class="card-img-top" alt="{{ $bebida->nome }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">Sem imagem</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $bebida->nome }}</h5>
                        <p class="card-text">
                            <small><strong>Tipo:</strong> {{ $bebida->categoriaBebida?->nome ?? 'N/A' }}</small><br>
                            <small><strong>Preço:</strong> R$ {{ number_format($bebida->preco, 2, ',', '.') }}</small><br>
                            <small><strong>Estoque:</strong> {{ $bebida->estoque }} unidades</small>
                        </p>
                        @if($bebida->descricao)
                            <p class="card-text"><small class="text-muted">{{ Str::limit($bebida->descricao, 80) }}</small></p>
                        @endif
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex gap-2">
                            <a href="{{ route('bebida.edit', $bebida->id) }}" class="btn btn-sm btn-warning flex-grow-1">Editar</a>
                            <form action="{{ route('bebida.destroy', $bebida->id) }}" method="POST" style="display:inline; flex-grow: 1;">
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
                    <p class="mb-0">Nenhuma bebida cadastrada</p>
                    <a href="{{ route('bebida.create') }}" class="btn btn-primary mt-3">Criar primeira bebida</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    @if($bebidas->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $bebidas->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
