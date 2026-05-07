@extends('layout')

@section('conteudo')
<div class="mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Controle de Estoque</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('estoque.create') }}" class="btn btn-primary me-2">Adicionar Produto</a>
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
                                                <button type="submit" form="deletePratoForm_{{ $prato->id }}" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Tem certeza que deseja deletar este prato?')">🗑️</button>
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
                                                <button type="submit" form="deleteBebidaForm_{{ $bebida->id }}" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Tem certeza que deseja deletar esta bebida?')">🗑️</button>
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

    @foreach($pratos as $prato)
        <form id="deletePratoForm_{{ $prato->id }}" method="POST" action="{{ route('estoque.destroy', ['tipo' => 'prato', 'id' => $prato->id]) }}" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
    @foreach($bebidas as $bebida)
        <form id="deleteBebidaForm_{{ $bebida->id }}" method="POST" action="{{ route('estoque.destroy', ['tipo' => 'bebida', 'id' => $bebida->id]) }}" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

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
    <div class="modal fade" id="novoProdutoModal" tabindex="-1" aria-labelledby="novoProdutoModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('estoque.store') }}" method="POST" enctype="multipart/form-data" id="modalFormEstoque">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="novoProdutoModalLabel">Adicionar Novo Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" id="formErrors" role="alert">
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
                                <label for="tipo" class="form-label">Tipo</label>
                                <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                                    <option value="">Selecione</option>
                                    <option value="prato" {{ old('tipo') == 'prato' ? 'selected' : '' }}>Prato</option>
                                    <option value="bebida" {{ old('tipo') == 'bebida' ? 'selected' : '' }}>Bebida</option>
                                </select>
                                @error('tipo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" type="text" value="{{ old('nome') }}" required>
                                @error('nome')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="2">{{ old('descricao') }}</textarea>
                                @error('descricao')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input id="preco" name="preco" class="form-control @error('preco') is-invalid @enderror" type="number" step="0.01" min="0" value="{{ old('preco') }}" required>
                                @error('preco')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="estoque" class="form-label">Estoque</label>
                                <input id="estoque" name="estoque" class="form-control @error('estoque') is-invalid @enderror" type="number" min="0" value="{{ old('estoque', 0) }}" required>
                                @error('estoque')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select id="categoria" name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" required>
                                    <option value="">Selecione um tipo primeiro</option>
                                </select>
                                @error('categoria_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="imagem" class="form-label">Foto do Produto</label>
                                <input id="imagem" name="imagem" class="form-control @error('imagem') is-invalid @enderror" type="file" accept="image/*">
                                @error('imagem')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
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
        const novoProdutoModal = document.getElementById('novoProdutoModal');
        const modalForm = document.getElementById('modalFormEstoque');

        let modalInstance = null;
        let modalIsShown = false;

        // Função para carregar categorias
        function carregarCategorias(tipo, categoriaId = null) {
            categoriaSelect.innerHTML = '<option value="">Selecione</option>';

            if (tipo === 'prato') {
                categoriasPratos.forEach(c => {
                    const option = document.createElement('option');
                    option.value = c.id;
                    option.text = c.nome;
                    if (categoriaId && c.id == categoriaId) option.selected = true;
                    categoriaSelect.appendChild(option);
                });
            } else if (tipo === 'bebida') {
                categoriasBebidas.forEach(c => {
                    const option = document.createElement('option');
                    option.value = c.id;
                    option.text = c.nome;
                    if (categoriaId && c.id == categoriaId) option.selected = true;
                    categoriaSelect.appendChild(option);
                });
            } else {
                categoriaSelect.innerHTML = '<option value="">Selecione um tipo primeiro</option>';
            }
        }

        // Inicializar modal
        function abrirModal() {
            if (!modalIsShown) {
                if (!modalInstance) {
                    modalInstance = new bootstrap.Modal(novoProdutoModal);
                }
                modalInstance.show();
                modalIsShown = true;
            }
        }

        // Fechar modal
        function fecharModal() {
            if (modalInstance) {
                modalInstance.hide();
                modalIsShown = false;
            }
        }

        // Manter modal aberto se houver erros
        @if ($errors->any())
            // Aguardar DOM estar pronto
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    abrirModal();
                    
                    // Carregar categorias com o tipo selecionado
                    const tipoSelecionado = tipoSelect.value;
                    const categoriaSelecionada = '{{ old('categoria_id') }}';
                    if (tipoSelecionado) {
                        carregarCategorias(tipoSelecionado, categoriaSelecionada);
                    }
                });
            } else {
                abrirModal();
                
                // Carregar categorias com o tipo selecionado
                const tipoSelecionado = tipoSelect.value;
                const categoriaSelecionada = '{{ old('categoria_id') }}';
                if (tipoSelecionado) {
                    carregarCategorias(tipoSelecionado, categoriaSelecionada);
                }
            }
        @endif

        // Eventos do modal
        novoProdutoModal.addEventListener('hidden.bs.modal', function() {
            modalIsShown = false;
        });

        novoProdutoModal.addEventListener('shown.bs.modal', function() {
            modalIsShown = true;
        });

        tipoSelect.addEventListener('change', function () {
            carregarCategorias(this.value);
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

        // Evento para limpar erros ao reenviar
        modalForm.addEventListener('submit', function(e) {
            const errorAlert = document.getElementById('formErrors');
            if (errorAlert) {
                errorAlert.remove();
            }
        });
    </script>
</div>
@endsection