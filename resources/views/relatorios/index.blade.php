<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatórios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body text-center">

            <h1 class="mb-4">?? Relatórios</h1>

            <div class="d-flex justify-content-center gap-3">

                <a href="{{ route('cliente.report') }}" class="btn btn-danger btn-lg">
                    PDF Clientes
                </a>

                <a href="{{ route('prato.report') }}" class="btn btn-warning btn-lg">
                    PDF Pratos
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>
