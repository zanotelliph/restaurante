@extends('layout')

@section('conteudo')
<div class="mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Controle de Estoque</h1>
        </div>
        <div class="col-md-4 text-end">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#novoProdutoModal">Adicionar Produto</button>
            <button type="submit" form="estoqueForm" class="btn btn-success">Salvar Alterações</button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Barra de Pesquisa -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('estoque.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nome..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-outline-primary">Buscar</button>
                @if(!empty($search))
                    <a href="{{ route('estoque.index') }}" class="btn btn-outline-secondary ms-2">Limpar</a>
                @endif
            </form>
        </div>
    </div>

    <form id="estoqueForm" action="{{ route('estoque.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>🍴 Pratos</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>Foto</th>
                                        <th>Estoque Atual</th>
                                        <th>Novo Estoque</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pratos as $prato)
                                        <tr>
                                            <td>{{ $prato->nome }}</td>
                                            <td>{{ $prato->categoriaPrato->nome ?? 'N/A' }}</td>
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
                                                    <span class="text-muted">Sem imagem</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-info">{{ $prato->estoque }}</span></td>
                                            <td>
                                                <input type="hidden" name="itens[{{ $loop->index }}][tipo]" value="prato">
                                                <input type="hidden" name="itens[{{ $loop->index }}][id]" value="{{ $prato->id }}">
                                                <input type="number" class="form-control" name="itens[{{ $loop->index }}][estoque]"
                                                       value="{{ $prato->estoque }}" min="0" style="width: 80px;">
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('estoque.destroy', ['tipo' => 'prato', 'id' => $prato->id]) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Tem certeza que deseja deletar este prato?')">🗑️</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>🥤 Bebidas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>Foto</th>
                                        <th>Estoque Atual</th>
                                        <th>Novo Estoque</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bebidas as $bebida)
                                        <tr>
                                            <td>{{ $bebida->nome }}</td>
                                            <td>{{ $bebida->categoriaBebida->nome ?? 'N/A' }}</td>
                                            <td>
                                                @php
                                                    $bebidaImageUrl = null;
                                                    if ($bebida->imagem) {
                                                        if (preg_match('/^(http|https):\/\//', $bebida->imagem)) {
                                                            $bebidaImageUrl = $bebida->imagem;
                                                        } elseif (file_exists(public_path('storage/'.$bebida->imagem))) {
                                                            $bebidaImageUrl = asset('storage/'.$bebida->imagem);
                                                        } elseif (file_exists(public_path($bebida->imagem))) {
                                                            $bebidaImageUrl = asset($bebida->imagem);
                                                        }
                                                    }
                                                @endphp

                                                @if($bebidaImageUrl)
                                                    <img src="{{ $bebidaImageUrl }}" alt="{{ $bebida->nome }}" style="height: 40px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <span class="text-muted">Sem imagem</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-info">{{ $bebida->estoque }}</span></td>
                                            <td>
                                                <input type="hidden" name="itens[{{ $loop->index + $pratos->count() }}][tipo]" value="bebida">
                                                <input type="hidden" name="itens[{{ $loop->index + $pratos->count() }}][id]" value="{{ $bebida->id }}">
                                                <input type="number" class="form-control" name="itens[{{ $loop->index + $pratos->count() }}][estoque]"
                                                       value="{{ $bebida->estoque }}" min="0" style="width: 80px;">
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('estoque.destroy', ['tipo' => 'bebida', 'id' => $bebida->id]) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Tem certeza que deseja deletar esta bebida?')">🗑️</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info">
                <strong>ℹ️ Como usar:</strong>
                <ul class="mb-0 mt-2">
                    <li>Use a barra de pesquisa para encontrar itens específicos por nome</li>
                    <li>Altere os valores de "Novo Estoque" conforme necessário</li>
                    <li>Clique em "Salvar Alterações" para atualizar todos os estoques</li>
                    <li>Use o botão 🗑️ para deletar itens permanentemente</li>
                    <li>Itens com estoque 0 não aparecerão disponíveis nos pedidos</li>
                </ul>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Voltar</a>
        </div>
    </div>

    <!-- Modal de Novo Produto -->
    <div class="modal fade" id="novoProdutoModal" tabindex="-1" aria-labelledby="novoProdutoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('estoque.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="novoProdutoModalLabel">Adicionar Novo Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select id="tipo" name="tipo" class="form-select" required>
                                    <option value="">Selecione</option>
                                    <option value="prato">Prato</option>
                                    <option value="bebida">Bebida</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input id="nome" name="nome" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea id="descricao" name="descricao" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input id="preco" name="preco" class="form-control" type="number" step="0.01" min="0" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="estoque" class="form-label">Estoque</label>
                                <input id="estoque" name="estoque" class="form-control" type="number" min="0" value="0" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select id="categoria" name="categoria_id" class="form-select" required>
                                    <option value="">Selecione um tipo primeiro</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="imagem" class="form-label">Foto do Produto</label>
                                <input id="imagem" name="imagem" class="form-control" type="file" accept="image/*">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pré-visualização</label>
                                <div><img id="previewImagem" src="" alt="Preview" class="img-fluid" style="max-height: 150px; display: none;"></div>
                            </div>
                        </div>

                        <input type="hidden" name="dummy" value="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const categoriasPratos = @json($categoriasPratos);
        const categoriasBebidas = @json($categoriasBebidas);

        const tipoSelect = document.getElementById('tipo');
        const categoriaSelect = document.getElementById('categoria');
        const imagemInput = document.getElementById('imagem');
        const previewImagem = document.getElementById('previewImagem');

        tipoSelect.addEventListener('change', function () {
            categoriaSelect.innerHTML = '<option value="">Selecione</option>';

            if (this.value === 'prato') {
                categoriasPratos.forEach(c => {
                    const option = document.createElement('option');
                    option.value = c.id;
                    option.text = c.nome;
                    categoriaSelect.appendChild(option);
                });
            } else if (this.value === 'bebida') {
                categoriasBebidas.forEach(c => {
                    const option = document.createElement('option');
                    option.value = c.id;
                    option.text = c.nome;
                    categoriaSelect.appendChild(option);
                });
            } else {
                categoriaSelect.innerHTML = '<option value="">Selecione um tipo primeiro</option>';
            }
        });

        imagemInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) {
                previewImagem.style.display = 'none';
                previewImagem.src = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImagem.src = e.target.result;
                previewImagem.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    </script>
</div>
@endsection