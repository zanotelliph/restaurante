@extends('layout')

@section('conteudo')
<div class="page-header mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1>{{ isset($pagamento) ? 'Editar Pagamento' : 'Novo Pagamento' }}</h1>
        <p class="text-muted">{{ isset($pagamento) ? 'Atualize os dados de pagamento.' : 'Registre um pagamento para um pedido.' }}</p>
    </div>
    <div>
        <a href="{{ route('pagamento.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($pagamento) ? route('pagamento.update', $pagamento->id) : route('pagamento.store') }}" method="POST">
            @csrf
            @if(isset($pagamento))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pedido_id" class="form-label">Pedido *</label>
                    @if(isset($pagamento))
                        <input type="text" class="form-control" value="#{{ $pagamento->pedido->id }} - {{ $pagamento->pedido->cliente->nome ?? 'Cliente' }}" disabled>
                        <input type="hidden" name="pedido_id" value="{{ $pagamento->pedido_id }}">
                    @else
                        <select id="pedido_id" name="pedido_id" class="form-select @error('pedido_id') is-invalid @enderror" required>
                            <option value="">Selecione um pedido</option>
                            @foreach($pedidos as $pedido)
                                <option value="{{ $pedido->id }}">#{{ $pedido->id }} - {{ $pedido->cliente->nome ?? 'Cliente sem nome' }}</option>
                            @endforeach
                        </select>
                        @error('pedido_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    @endif
                </div>
                <div class="col-md-3 mb-3">
                    <label for="valor" class="form-label">Valor *</label>
                    <input type="number" step="0.01" min="0" id="valor" name="valor" class="form-control @error('valor') is-invalid @enderror" value="{{ old('valor', $pagamento->valor ?? '') }}" required>
                    @error('valor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="metodo" class="form-label">Método *</label>
                    <select id="metodo" name="metodo" class="form-select @error('metodo') is-invalid @enderror" required>
                        @foreach(['dinheiro' => 'Dinheiro', 'cartao' => 'Cartão', 'pix' => 'Pix', 'boleto' => 'Boleto'] as $key => $label)
                            <option value="{{ $key }}" {{ old('metodo', $pagamento->metodo ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('metodo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        @foreach(['pendente' => 'Pendente', 'aprovado' => 'Aprovado', 'recusado' => 'Recusado'] as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $pagamento->status ?? 'pendente') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pago_em" class="form-label">Data do Pagamento</label>
                    <input type="datetime-local" id="pago_em" name="pago_em" class="form-control @error('pago_em') is-invalid @enderror" value="{{ old('pago_em', isset($pagamento->pago_em) ? $pagamento->pago_em->format('Y-m-d\TH:i') : '') }}">
                    @error('pago_em')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea id="observacoes" name="observacoes" rows="3" class="form-control">{{ old('observacoes', $pagamento->observacoes ?? '') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ isset($pagamento) ? 'Atualizar' : 'Salvar Pagamento' }}</button>
                <a href="{{ route('pagamento.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
