<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Pratos</title>
</head>

<body>

    <h3>{{ $titulo }}</h3>

    <table class="table table-hover" border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pratos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>R$ {{ $item->preco }}</td>
                    <td>{{ $item->estoque }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>