@extends('layout')

@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 text-2xl font-bold text-gray-700">👤 Clientes</h2>
    <form method="GET" action="{{ route('cliente.index') }}" class="d-flex" style="gap: 0.5rem;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por nome, email ou CPF" />
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<table class="table table-hover table-striped">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Nome</th>
<th>Telefone</th>
<th>Email</th>
</tr>
</thead>

<tbody>

@foreach($clientes as $cliente)

<tr>
<td>{{ $cliente->id }}</td>
<td class="fw-semibold">{{ $cliente->nome }}</td>
<td>{{ $cliente->telefone }}</td>
<td>{{ $cliente->email }}</td>
</tr>

@endforeach

</tbody>

</table>

@endsection