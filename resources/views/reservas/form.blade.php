@extends('layout')

@section('conteudo')
<div class="page-header mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1>{{ isset($reserva) ? 'Editar Reserva' : 'Nova Reserva' }}</h1>
        <p class="text-muted">{{ isset($reserva) ? 'Atualize os dados da reserva.' : 'Cadastre uma nova reserva para o cliente.' }}</p>
    </div>
    <div>
        <a href="{{ route('reserva.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($reserva) ? route('reserva.update', $reserva->id) : route('reserva.store') }}" method="POST">
            @csrf
            @if(isset($reserva))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cliente_id" class="form-label">Cliente *</label>
                    <select id="cliente_id" name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                        <option value="">Escolha um cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id', $reserva->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="data_reserva" class="form-label">Data *</label>
                    <input type="date" id="data_reserva" name="data_reserva" class="form-control @error('data_reserva') is-invalid @enderror" value="{{ old('data_reserva', $reserva->data_reserva ?? '') }}" required>
                    @error('data_reserva')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="hora_reserva" class="form-label">Hora *</label>
                    <input type="time" id="hora_reserva" name="hora_reserva" class="form-control @error('hora_reserva') is-invalid @enderror" value="{{ old('hora_reserva', $reserva->hora_reserva ?? '') }}" required>
                    @error('hora_reserva')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="pessoas" class="form-label">Pessoas *</label>
                    <input type="number" id="pessoas" name="pessoas" min="1" class="form-control @error('pessoas') is-invalid @enderror" value="{{ old('pessoas', $reserva->pessoas ?? 1) }}" required>
                    @error('pessoas')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        @foreach(['pendente' => 'Pendente', 'confirmada' => 'Confirmada', 'cancelada' => 'Cancelada'] as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $reserva->status ?? 'pendente') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea id="observacoes" name="observacoes" rows="4" class="form-control">{{ old('observacoes', $reserva->observacoes ?? '') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ isset($reserva) ? 'Atualizar' : 'Salvar Reserva' }}</button>
                <a href="{{ route('reserva.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
