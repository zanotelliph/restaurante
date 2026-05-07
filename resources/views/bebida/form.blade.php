@extends('form-layout')

@section('conteudo')

<style>
    .fullscreen-form-container {
        display: flex;
        flex-direction: column;
        min-height: calc(100vh - 150px);
        background: #fff;
        margin: -20px;
    }
    .form-header {
        background: linear-gradient(135deg, #0066CC 0%, #0052A3 100%);
        color: white;
        padding: 30px;
        border-bottom: 3px solid #0099FF;
    }
    .form-header h1 {
        margin: 0 0 5px 0;
        font-size: 2rem;
    }
    .form-header p {
        margin: 0;
        opacity: 0.9;
    }
    .form-content {
        flex: 1;
        overflow-y: auto;
        padding: 30px;
    }
    .form-actions {
        padding: 20px 30px;
        background: #f8f9fa;
        border-top: 1px solid #dee2e6;
        display: flex;
        gap: 10px;
        position: sticky;
        bottom: 0;
    }
    .form-actions .btn {
        min-width: 120px;
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
    }
</style>

<div class="fullscreen-form-container">
    <div class="form-header">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h1>{{ isset($bebida) ? '✏️ Editar Bebida' : '➕ Nova Bebida' }}</h1>
                <p>{{ isset($bebida) ? 'Atualize os dados desta bebida.' : 'Cadastre uma nova bebida para o estoque.' }}</p>
            </div>
            <a href="{{ route('estoque.index') }}" class="btn btn-light">← Voltar</a>
        </div>
    </div>

    <div class="form-content">
        <form id="bebidasForm" action="{{ isset($bebida) ? route('bebida.update', $bebida->id) : route('bebida.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($bebida))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $bebida->nome ?? '') }}" required>
                    @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="preco" class="form-label">Preço *</label>
                    <input type="number" class="form-control @error('preco') is-invalid @enderror" id="preco" name="preco" step="0.01" value="{{ old('preco', $bebida->preco ?? '') }}" required>
                    @error('preco')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $bebida->descricao ?? '') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="categoria_bebida_id" class="form-label">Tipo *</label>
                    <select class="form-select @error('categoria_bebida_id') is-invalid @enderror" id="categoria_bebida_id" name="categoria_bebida_id" required>
                        <option value="">-- Selecione um tipo --</option>
                        @foreach($categoriasBebidas ?? [] as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_bebida_id', $bebida->categoria_bebida_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_bebida_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estoque" class="form-label">Quantidade em Estoque *</label>
                    <input type="number" class="form-control @error('estoque') is-invalid @enderror" id="estoque" name="estoque" min="0" value="{{ old('estoque', $bebida->estoque ?? 0) }}" required>
                    <small class="text-muted">Quantidade disponível em estoque</small>
                    @error('estoque')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Foto da Bebida</label>
                <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/*" onchange="previewImage(this)">
                <small class="text-muted">Formatos aceitos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                @error('imagem')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
            </div>

            @if(isset($bebida) && $bebida->imagem)
                <div class="mb-3">
                    <p class="text-muted mb-2">Foto atual:</p>
                    <img src="{{ asset($bebida->imagem) }}" alt="Foto da bebida" class="img-preview">
                </div>
            @endif

            <div class="mb-3">
                <img id="preview" class="img-preview d-none" style="display: none;">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg">{{ isset($bebida) ? 'Atualizar' : 'Criar' }}</button>
                <a href="{{ route('estoque.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="form-actions">
        <div style="display: flex; gap: 10px; width: 100%; justify-content: flex-start;">
            <button type="submit" form="bebidasForm" class="btn btn-primary btn-lg">✓ {{ isset($bebida) ? 'Atualizar' : 'Criar' }}</button>
            <a href="{{ route('estoque.index') }}" class="btn btn-secondary btn-lg">← Cancelar</a>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
