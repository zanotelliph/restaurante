@extends('layout')

@section('conteudo')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>{{ isset($reserva) ? 'Editar reserva' : 'Nova reserva' }}</h1>
            <form action="{{ isset($reserva) ? route('reserva.update', $reserva->id) : route('reserva.store') }}" method="POST">
                @csrf
                @if(isset($reserva))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nome_cliente" class="form-label">Nome do Cliente *</label>
                    <input type="text" class="form-control @error('nome_cliente') is-invalid @enderror" id="nome_cliente" name="nome_cliente" 
                        value="{{ old('nome_cliente', $reserva->nome_cliente ?? '') }}" required>
                    @error('nome_cliente')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="data_reserva" class="form-label">Data e Hora da Reserva *</label>
                    <input type="datetime-local" class="form-control @error('data_reserva') is-invalid @enderror" id="data_reserva" name="data_reserva" 
                        value="{{ old('data_reserva', isset($reserva) ? $reserva->data_reserva->format('Y-m-d\TH:i') : '') }}" required>    
                    @error('data_reserva')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>  
                <div class="mb-3">
                    <label for="numero_pessoas" class="form-label">Número de Pessoas *</label>
                    <input type="number" class="form-control @error('numero_pessoas') is-invalid @enderror" id="numero_pessoas" name="numero_pessoas" 
                        min="1" value="{{ old('numero_pessoas', $reserva->numero_pessoas ?? 1) }}" required>
                    @error('numero_pessoas')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="mb-3">
                    <label for="contato" class="form-label">Contato (Telefone ou Email) *</label>
                    <input type="text" class="form-control @error('contato') is-invalid @enderror" id="contato" name="contato" 
                        value="{{ old('contato', $reserva->contato ?? '') }}" required>
                    @error('contato')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($reserva) ? 'Atualizar Reserva' : 'Criar Reserva' }}</button>
            </form>
        </div>
    </div>