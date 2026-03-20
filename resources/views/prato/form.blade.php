@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>{{ isset($prato) ? 'Editar Prato' : 'Novo Prato' }}</h1>

            <form action="{{ isset($prato) ? route('prato.update', $prato->id) : route('prato.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($prato))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" 
                        value="{{ old('nome', $prato->nome ?? '') }}" required>
                    @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $prato->descricao ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="preco" class="form-label">Preço *</label>
                    <input type="number" class="form-control @error('preco') is-invalid @enderror" id="preco" name="preco" 
                        step="0.01" value="{{ old('preco', $prato->preco ?? '') }}" required>
                    @error('preco')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="categoria_prato_id" class="form-label">Categoria *</label>
                    <select class="form-select @error('categoria_prato_id') is-invalid @enderror" id="categoria_prato_id" name="categoria_prato_id" required>
                        <option value="">-- Selecione uma categoria --</option>
                        @foreach($categoriasPratos ?? [] as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_prato_id', $prato->categoria_prato_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_prato_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="estoque" class="form-label">Quantidade em Estoque *</label>
                    <input type="number" class="form-control @error('estoque') is-invalid @enderror" id="estoque" name="estoque" 
                        min="0" value="{{ old('estoque', $prato->estoque ?? 0) }}" required>
                    <small class="form-text text-muted">Quantidade disponível em estoque</small>
                    @error('estoque')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="imagem" class="form-label">Foto do Prato</label>
                    <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/*" onchange="previewImage(this)">
                    <small class="form-text text-muted">Formatos aceitos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                    @error('imagem')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    
                    @if(isset($prato) && $prato->imagem)
                        <div class="mt-3">
                            <p class="text-muted">Foto atual:</p>
                            <img src="{{ asset($prato->imagem) }}" alt="Foto do prato" class="img-preview">
                        </div>
                    @endif
                    <img id="preview" class="img-preview d-none" style="display: none;">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($prato) ? 'Atualizar' : 'Criar' }}</button>
                    <a href="{{ route('prato.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
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
