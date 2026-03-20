@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>{{ isset($cliente) ? 'Editar Cliente' : 'Novo Cliente' }}</h1>

            <form action="{{ isset($cliente) ? route('cliente.update', $cliente->id) : route('cliente.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($cliente))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" 
                        value="{{ old('nome', $cliente->nome ?? '') }}" required>
                    @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                        value="{{ old('email', $cliente->email ?? '') }}" required>
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" 
                        value="{{ old('telefone', $cliente->telefone ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF *</label>
                    <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" 
                        value="{{ old('cpf', $cliente->cpf ?? '') }}" required>
                    @error('cpf')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <textarea class="form-control" id="endereco" name="endereco" rows="3">{{ old('endereco', $cliente->endereco ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="imagem" class="form-label">Foto do Cliente</label>
                    <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/*" onchange="previewImage(this)">
                    <small class="form-text text-muted">Formatos aceitos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                    @error('imagem')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    
                    @if(isset($cliente) && $cliente->imagem)
                        <div class="mt-3">
                            <p class="text-muted">Foto atual:</p>
                            <img src="{{ asset($cliente->imagem) }}" alt="Foto do cliente" class="img-preview">
                        </div>
                    @endif
                    <img id="preview" class="img-preview d-none" style="display: none;">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($cliente) ? 'Atualizar' : 'Criar' }}</button>
                    <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Cancelar</a>
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
