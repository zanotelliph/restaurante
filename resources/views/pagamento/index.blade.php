@extends('layout')

@section('conteudo')
<div class="mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Controle de Pagamentos</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pagamento.create') }}" class="btn btn-primary">Registrar Novo Pagamento</a>
        </div>
    </div>  
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Data do Pagamento</th>
                    <th>Método de Pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagamentos as $pagamento)
                <tr>
                    <td>{{ $pagamento->id }}</td>
                    <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                    <td>{{ $pagamento->data_pagamento->format('d/m/Y H:i') }}</td>
                    <td>{{ $pagamento->metodo_pagamento }}</td>
                    <td>
                        <a href="{{ route('pagamento.edit', $pagamento->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('pagamento.destroy', $pagamento->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este pagamento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $pagamentos->links() }} <!-- Paginação -->