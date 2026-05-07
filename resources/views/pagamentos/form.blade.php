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
                <h1>{{ isset($pagamento) ? '✏️ Editar Pagamento' : '➕ Novo Pagamento' }}</h1>
                <p>{{ isset($pagamento) ? 'Atualize os dados de pagamento.' : 'Registre um pagamento para um pedido.' }}</p>
            </div>
            <a href="{{ route('pagamento.index') }}" class="btn btn-light">← Voltar</a>
        </div>
    </div>

    <div class="form-content">
        <form id="pagamentosForm" action="{{ isset($pagamento) ? route('pagamento.update', $pagamento->id) : route('pagamento.store') }}" method="POST">
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

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg">{{ isset($pagamento) ? 'Atualizar' : 'Salvar Pagamento' }}</button>
                <a href="{{ route('pagamento.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="form-actions">
        <div style="display: flex; gap: 10px; width: 100%; justify-content: flex-start;">
            <button type="submit" form="pagamentosForm" class="btn btn-primary btn-lg">✓ {{ isset($pagamento) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('pagamento.index') }}" class="btn btn-secondary btn-lg">← Cancelar</a>
        </div>
    </div>
</div>
@endsection
