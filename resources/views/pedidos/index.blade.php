@extends('layout')

@section('conteudo')

<h2 class="mb-4 text-2xl font-bold text-gray-700">
👤 Pedidos
</h2>

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

@foreach($pedidos as $pedido)

<tr>
<td>{{ $pedido->id }}</td>
<td class="fw-semibold">{{ $pedido->nome }}</td>
<td>{{ $pedido->telefone }}</td>
<td>{{ $pedido->email }}</td>
</tr>

@endforeach

</tbody>

</table>

@endsection