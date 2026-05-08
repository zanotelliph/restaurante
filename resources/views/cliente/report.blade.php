<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
</head>

<body>

    <h3>{{ $titulo }}</h3>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($clientes as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->telefone }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>