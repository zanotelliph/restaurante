@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>{{ isset($bebida) ? 'Editar Bebida' : 'Nova Bebida' }}</h1>

            <form action="{{ isset($bebida) ? route('bebida.update', $bebida->id) : route('bebida.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($bebida))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" 
                        value="{{ old('nome', $bebida->nome ?? '') }}" required>
                    @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $bebida->descricao ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="preco" class="form-label">Preço *</label>
                    <input type="number" class="form-control @error('preco') is-invalid @enderror" id="preco" name="preco" 
                        step="0.01" value="{{ old('preco', $bebida->preco ?? '') }}" required>
                    @error('preco')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
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

                <div class="mb-3">
                    <label for="estoque" class="form-label">Quantidade em Estoque *</label>
                    <input type="number" class="form-control @error('estoque') is-invalid @enderror" id="estoque" name="estoque" 
                        min="0" value="{{ old('estoque', $bebida->estoque ?? 0) }}" required>
                    <small class="form-text text-muted">Quantidade disponível em estoque</small>
                    @error('estoque')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="imagem" class="form-label">Foto da Bebida</label>
                    <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/*" onchange="previewImage(this)">
                    <small class="form-text text-muted">Formatos aceitos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                    @error('imagem')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    
                    @if(isset($bebida) && $bebida->imagem)
                        <div class="mt-3">
                            <p class="text-muted">Foto atual:</p>
                            <img src="{{ asset($bebida->imagem) }}" alt="Foto da bebida" class="img-preview">
                        </div>
                    @endif
                    <img id="preview" class="img-preview d-none" style="display: none;">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="disponivel" name="disponivel" value="1"
                        {{ old('disponivel', $bebida->disponivel ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="disponivel">Disponível</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($bebida) ? 'Atualizar' : 'Criar' }}</button>
                    <a href="{{ route('bebida.index') }}" class="btn btn-secondary">Cancelar</a>
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
