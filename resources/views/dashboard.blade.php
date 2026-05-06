@extends('layout')

@section('conteudo')
<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-4">🍽️ Bem-vindo ao BigHouse</h1>
            <p class="text-muted">Gerenciamento completo de clientes, pedidos e estoque</p>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-12">
            <div class="alert alert-info">
                <strong>ℹ️ Informações Úteis:</strong>
                <ul class="mb-0 mt-2">
                    <li>Use o menu superior para acessar cada seção</li>
                    <li>Clique em "Novo" para adicionar um novo item</li>
                    <li>Use "Editar" para modificar informações existentes</li>
                    <li>Clique em "Deletar" para remover um item</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.icon-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: rgba(102, 126, 234, 0.12);
    border: 1px solid rgba(102, 126, 234, 0.18);
    margin: 0 auto 1rem auto;
}

.dashboard-card .card-body.text-center {
    padding: 2rem 1.5rem;
}

.dashboard-card .btn-sm {
    min-width: 140px;
}
</style>
@endsection
