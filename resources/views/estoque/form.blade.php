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
    .img-preview {
        max-height: 150px;
        margin-top: 10px;
    }
</style>

<div class="fullscreen-form-container">
    <div class="form-header">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h1>➕ Adicionar Novo Produto</h1>
                <p>Cadastre um novo produto ao estoque do restaurante.</p>
            </div>
            <a href="{{ route('estoque.index') }}" class="btn btn-light">← Voltar</a>
        </div>
    </div>

    <div class="form-content">
        <form id="estoqueForm" action="{{ route('estoque.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <strong>Erros na validação:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tipo" class="form-label">Tipo *</label>
                    <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                        <option value="">Selecione</option>
                        <option value="prato" {{ old('tipo') == 'prato' ? 'selected' : '' }}>Prato</option>
                        <option value="bebida" {{ old('tipo') == 'bebida' ? 'selected' : '' }}>Bebida</option>
                    </select>
                    @error('tipo')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" type="text" value="{{ old('nome') }}" required>
                    @error('nome')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="3">{{ old('descricao') }}</textarea>
                    @error('descricao')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="preco" class="form-label">Preço *</label>
                    <input id="preco" name="preco" class="form-control @error('preco') is-invalid @enderror" type="number" step="0.01" min="0" value="{{ old('preco') }}" required>
                    @error('preco')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="estoque" class="form-label">Estoque *</label>
                    <input id="estoque" name="estoque" class="form-control @error('estoque') is-invalid @enderror" type="number" min="0" value="{{ old('estoque', 0) }}" required>
                    @error('estoque')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="categoria" class="form-label">Categoria *</label>
                    <select id="categoria" name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" required>
                        <option value="">Selecione um tipo primeiro</option>
                    </select>
                    @error('categoria_id')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="imagem" class="form-label">Foto do Produto</label>
                    <input id="imagem" name="imagem" class="form-control @error('imagem') is-invalid @enderror" type="file" accept="image/*" onchange="previewImage(this)">
                    <small class="text-muted">Formatos aceitos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                    @error('imagem')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pré-visualização</label>
                    <div>
                        <img id="previewImagem" src="" alt="Preview" class="img-fluid img-preview" style="display: none;">
                    </div>
                </div>
            </div>

            <input type="hidden" name="dummy" value="1">
        </form>
    </div>

    <div class="form-actions">
        <div style="display: flex; gap: 10px; width: 100%; justify-content: flex-start;">
            <button type="submit" form="estoqueForm" class="btn btn-primary btn-lg">✓ Salvar Produto</button>
            <a href="{{ route('estoque.index') }}" class="btn btn-secondary btn-lg">← Cancelar</a>
        </div>
    </div>
</div>

<script>
    const tipoSelect = document.getElementById('tipo');
    const categoriaSelect = document.getElementById('categoria');

    // Categorias para cada tipo
    const categoriasPorTipo = {
        prato: [
            { id: '{{ \App\Models\CategoriaPrato::first()->id ?? 1 }}', nome: 'Carnes' },
            { id: '{{ \App\Models\CategoriaPrato::skip(1)->first()->id ?? 2 }}', nome: 'Peixes' },
            { id: '{{ \App\Models\CategoriaPrato::skip(2)->first()->id ?? 3 }}', nome: 'Saladas' },
            { id: '{{ \App\Models\CategoriaPrato::skip(3)->first()->id ?? 4 }}', nome: 'Acompanhamentos' }
        ],
        bebida: [
            { id: '{{ \App\Models\CategoriaBebida::first()->id ?? 1 }}', nome: 'Bebidas Quentes' },
            { id: '{{ \App\Models\CategoriaBebida::skip(1)->first()->id ?? 2 }}', nome: 'Bebidas Frias' },
            { id: '{{ \App\Models\CategoriaBebida::skip(2)->first()->id ?? 3 }}', nome: 'Alcoólicas' }
        ]
    };

    tipoSelect.addEventListener('change', function() {
        const tipo = this.value;
        categoriaSelect.innerHTML = '<option value="">Selecione uma categoria</option>';

        if (tipo && categoriasPorTipo[tipo]) {
            categoriasPorTipo[tipo].forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.nome;
                categoriaSelect.appendChild(option);
            });
        }
    });

    function previewImage(input) {
        const preview = document.getElementById('previewImagem');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
