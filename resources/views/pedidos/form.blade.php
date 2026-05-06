@extends('layout')

@section('conteudo')

<div class="page-header">
    <div>
        <h1>{{ isset($pedido) ? 'Editar Pedido' : 'Novo Pedido' }}</h1>
        <p class="text-muted">{{ isset($pedido) ? 'Atualize os detalhes do pedido.' : 'Cadastre um novo pedido para o cliente.' }}</p>
    </div>
    <div class="action-bar">
        <a href="{{ route('pedido.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
</div>

<form id="formPedido" method="POST" class="card p-4">
    @csrf
    @if(isset($pedido))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="cliente_id" class="form-label"><strong>Cliente</strong></label>
            <select class="form-control @error('cliente_id') is-invalid @enderror" id="cliente_id" name="cliente_id" required>
                <option value="">Selecione um cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ (isset($pedido) && $pedido->cliente_id == $cliente->id) ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if(isset($pedido))
        <div class="col-md-6 mb-3">
            <label for="status" class="form-label"><strong>Status</strong></label>
            <select class="form-control" id="status" name="status">
                <option value="pendente" {{ $pedido->status === 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="confirmado" {{ $pedido->status === 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                <option value="entregue" {{ $pedido->status === 'entregue' ? 'selected' : '' }}>Entregue</option>
                <option value="cancelado" {{ $pedido->status === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>
        @endif
    </div>

    @if(!isset($pedido))
    <div class="mt-5">
        <h4>🍽️ Adicionar Itens</h4>
        <div id="itemsContainer" class="mb-4"></div>
        <button type="button" class="btn btn-info me-2" onclick="adicionarPrato()">+ Prato</button>
        <button type="button" class="btn btn-info" onclick="adicionarBebida()">+ Bebida</button>
    </div>

    <div id="tabelaItens" class="mt-4" style="display:none;">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Tipo</th>
                        <th>Item</th>
                        <th>Quantidade</th>
                        <th>Preço Unit.</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="bodyItens"></tbody>
            </table>
        </div>
        <div class="alert alert-info">
            <strong>Total do Pedido:</strong> R$ <span id="totalPedido">0.00</span>
        </div>
    </div>
    @else
    <div class="mt-5">
        <h4>📋 Itens do Pedido</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tipo</th>
                        <th>Item</th>
                        <th>Quantidade</th>
                        <th>Preço Unit.</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedido->itens as $item)
                    <tr>
                        <td>{{ $item->prato_id ? 'Prato' : 'Bebida' }}</td>
                        <td>{{ $item->prato?->nome ?? $item->bebida?->nome }}</td>
                        <td>{{ $item->quantidade }}</td>
                        <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="alert alert-info">
            <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</div>
    </div>
    @endif

    <div class="mb-3 mt-5">
        <label for="observacoes" class="form-label">Observações</label>
        <textarea class="form-control" id="observacoes" name="observacoes" rows="3">{{ $pedido->observacoes ?? '' }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary" @if(!isset($pedido) && false) disabled @endif>
            {{ isset($pedido) ? 'Atualizar' : 'Criar Pedido' }}
        </button>
        <a href="{{ route('pedido.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

@if(!isset($pedido))
<script>
let itemIndex = 0;

function adicionarPrato() {
    const select = `
    <div class="card mb-3 item-card" data-index="${itemIndex}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Prato</label>
                    <select class="form-control select-prato" onchange="atualizarTabela()">
                        <option value="">Selecione</option>
                        @foreach($pratos as $prato)
                            <option value="{{ $prato->id }}" data-preco="{{ $prato->preco }}" data-nome="{{ $prato->nome }}">
                                {{ $prato->nome }} (R$ {{ number_format($prato->preco, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Quantidade</label>
                    <input type="number" class="form-control input-quantidade" min="1" value="1" onchange="atualizarTabela()">
                </div>
                <div class="col-md-2 mb-2">
                    <br>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removerItem(${itemIndex})">🗑️</button>
                </div>
            </div>
        </div>
    </div>
    `;
    document.getElementById('itemsContainer').innerHTML += select;
    itemIndex++;
    atualizarTabela();
}

function adicionarBebida() {
    const select = `
    <div class="card mb-3 item-card" data-index="${itemIndex}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Bebida</label>
                    <select class="form-control select-bebida" onchange="atualizarTabela()">
                        <option value="">Selecione</option>
                        @foreach($bebidas as $bebida)
                            <option value="{{ $bebida->id }}" data-preco="{{ $bebida->preco }}" data-nome="{{ $bebida->nome }}">
                                {{ $bebida->nome }} (R$ {{ number_format($bebida->preco, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Quantidade</label>
                    <input type="number" class="form-control input-quantidade" min="1" value="1" onchange="atualizarTabela()">
                </div>
                <div class="col-md-2 mb-2">
                    <br>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removerItem(${itemIndex})">🗑️</button>
                </div>
            </div>
        </div>
    </div>
    `;
    document.getElementById('itemsContainer').innerHTML += select;
    itemIndex++;
    atualizarTabela();
}

function removerItem(index) {
    document.querySelector(`[data-index="${index}"]`).remove();
    atualizarTabela();
}

function atualizarTabela() {
    const items = document.querySelectorAll('.item-card');
    const tbody = document.getElementById('bodyItens');
    const tabelaDiv = document.getElementById('tabelaItens');
    tbody.innerHTML = ''; 
    let total = 0;
    let temItens = false;

    items.forEach(item => {
        const selectPrato = item.querySelector('.select-prato');
        const selectBebida = item.querySelector('.select-bebida');
        const select = selectPrato || selectBebida;
        const quantidade = parseInt(item.querySelector('.input-quantidade').value);

        if (select && select.value) {
            temItens = true;
            const option = select.options[select.selectedIndex];
            const preco = parseFloat(option.dataset.preco);
            const nome = option.dataset.nome;
            const tipo = selectPrato ? 'Prato' : 'Bebida';
            const subtotal = preco * quantidade;
            total += subtotal;

            tbody.innerHTML += `
                <tr>
                    <td>${tipo}</td>
                    <td>${nome}</td>
                    <td>${quantidade}</td>
                    <td>R$ ${preco.toFixed(2).replace('.', ',')}</td>
                    <td>R$ ${subtotal.toFixed(2).replace('.', ',')}</td>
                </tr>
            `;
        }
    });

    tabelaDiv.style.display = temItens ? 'block' : 'none';
    document.getElementById('totalPedido').textContent = total.toFixed(2).replace('.', ',');
    document.querySelector('button[type="submit"]').disabled = !temItens;
}

document.getElementById('formPedido').addEventListener('submit', function(e) {
    const items = document.querySelectorAll('.item-card');
    let itemCount = 0;

    items.forEach(item => {
        const selectPrato = item.querySelector('.select-prato');
        const selectBebida = item.querySelector('.select-bebida');
        const select = selectPrato || selectBebida;
        const quantidade = item.querySelector('.input-quantidade').value;

        if (select && select.value) {
            const option = select.options[select.selectedIndex];
            const tipo = selectPrato ? 'prato' : 'bebida';
            const id_val = select.value;
            const preco = option.dataset.preco;

            const input1 = document.createElement('input');
            input1.type = 'hidden';
            input1.name = `itens[${itemCount}][tipo]`;
            input1.value = tipo;

            const input2 = document.createElement('input');
            input2.type = 'hidden';
            input2.name = `itens[${itemCount}][id]`;
            input2.value = id_val;

            const input3 = document.createElement('input');
            input3.type = 'hidden';
            input3.name = `itens[${itemCount}][quantidade]`;
            input3.value = quantidade;

            const input4 = document.createElement('input');
            input4.type = 'hidden';
            input4.name = `itens[${itemCount}][preco]`;
            input4.value = preco;

            this.appendChild(input1);
            this.appendChild(input2);
            this.appendChild(input3);
            this.appendChild(input4);
            itemCount++;
        }
    });

    if (itemCount === 0) {
        e.preventDefault();
        alert('Adicione pelo menos um item ao pedido!');
    }
});
</script>
@endif

@endsection
