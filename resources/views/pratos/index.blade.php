@extends('layout')

@section('conteudo')

<div class="page-header">
    <div>
        <h1>Pratos</h1>
        <p class="text-muted">Visualize os pratos cadastrados e seus preços.</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Pratos cadastrados</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pratos as $prato)
                        <tr>
                            <td>{{ $prato->id }}</td>
                            <td>
                                @php
                                    $pratoImageUrl = null;
                                    if ($prato->imagem) {
                                        if (preg_match('/^(http|https):\/\//', $prato->imagem)) {
                                            $pratoImageUrl = $prato->imagem;
                                        } elseif (file_exists(public_path('storage/'.$prato->imagem))) {
                                            $pratoImageUrl = asset('storage/'.$prato->imagem);
                                        } elseif (file_exists(public_path($prato->imagem))) {
                                            $pratoImageUrl = asset($prato->imagem);
                                        }
                                    }
                                @endphp
                                @if($pratoImageUrl)
                                    <img src="{{ $pratoImageUrl }}" alt="{{ $prato->nome }}" style="height: 40px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <span class="text-muted text-sm">Sem imagem</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $prato->nome }}</td>
                            <td>{{ $prato->categoriaPrato->nome ?? 'N/A' }}</td>
                            <td class="text-success fw-bold">R$ {{ number_format($prato->preco, 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Nenhum prato cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

<a href="{{ route('prato.report') }}" class="btn btn-danger">Baixar PDF</a>
