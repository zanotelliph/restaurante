<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico - Pratos por Categoria</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .chart-container {
            margin-top: 30px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 15px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            background: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>🍽️ Gráfico de Pratos por Categoria</h1>

        <div class="chart-container">
            {!! $chart->container() !!}
        </div>

        <div class="actions">
            <a href="{{ route('grafico.clientes-pedidos') }}" class="btn">
                Ver Gráfico de Clientes
            </a>

            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                Voltar ao Dashboard
            </a>
        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {!! $chart->script() !!}

</body>

</html>