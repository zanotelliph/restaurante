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
                <h1>{{ isset($cliente) ? '✏️ Editar Cliente' : '➕ Novo Cliente' }}</h1>
                <p>{{ isset($cliente) ? 'Atualize os dados do cliente existente.' : 'Cadastre um novo cliente no sistema.' }}</p>
            </div>
            <a href="{{ route('cliente.index') }}" class="btn btn-light">← Voltar</a>
        </div>
    </div>

    <div class="form-content">
        <form id="clienteForm" action="{{ isset($cliente) ? route('cliente.update', $cliente->id) : route('cliente.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($cliente))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $cliente->nome ?? '') }}" required>
                    @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $cliente->email ?? '') }}" required>
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control @error('telefone') is-invalid @enderror" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone ?? '') }}">
                    @error('telefone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cpf" class="form-label">CPF *</label>
                    <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf ?? '') }}" required>
                    @error('cpf')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="endereco" name="endereco" value="{{ old('endereco', $cliente->endereco ?? '') }}">
                @error('endereco')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Foto do Cliente</label>
                <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/*" onchange="previewImage(this)">
                <small class="text-muted">Formatos aceitos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                @error('imagem')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
            </div>

            @if(isset($cliente) && $cliente->imagem)
                <div class="mb-3">
                    <p class="text-muted mb-2">Foto atual:</p>
                    <img src="{{ asset($cliente->imagem) }}" alt="Foto do cliente" class="img-preview">
                </div>
            @endif

            <div class="mb-3">
                <img id="preview" class="img-preview d-none" style="display: none;">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg">{{ isset($cliente) ? 'Atualizar' : 'Criar' }}</button>
                <a href="{{ route('cliente.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="form-actions">
        <div style="display: flex; gap: 10px; width: 100%; justify-content: flex-start;">
            <button type="submit" form="clienteForm" class="btn btn-primary btn-lg">{{ isset($cliente) ? '✓ Atualizar' : '+ Criar' }}</button>
            <a href="{{ route('cliente.index') }}" class="btn btn-secondary btn-lg">← Cancelar</a>
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
