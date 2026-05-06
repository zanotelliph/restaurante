<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico - Pratos por Categoria</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 900px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .chart-wrapper {
            position: relative;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #764ba2;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .stat-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-label {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .stat-value {
            color: #667eea;
            font-size: 24px;
            font-weight: bold;
        }

        .legend-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .legend-table th,
        .legend-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .legend-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> Gráfico de Pizza</h1>
        <p class="subtitle">Distribuição de Pratos por Categoria</p>

        <div class="chart-wrapper">
            <div style="width: 100%; max-width: 500px;">
                <canvas id="chartPratos"></canvas>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('grafico.clientes-pedidos') }}" class="btn">Ver Gráfico de Barras</a>
            <a href="{{ route('relatorio.pedidos') }}" class="btn btn-secondary">Relatório de Pedidos</a>
            <a href="{{ route('relatorio.clientes') }}" class="btn btn-secondary">Relatório de Clientes</a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </div>

        <table class="legend-table">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Percentual</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = array_sum($valores);
                @endphp
                @foreach($labels as $index => $label)
                <tr>
                    <td>
                        <span class="legend-color" style="background-color: {{ $cores[$index % count($cores)] }};"></span>
                        {{ $label }}
                    </td>
                    <td>{{ $valores[$index] }}</td>
                    <td>{{ round(($valores[$index] / $total) * 100, 1) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="stats">
            <div class="stat-box">
                <div class="stat-label">Total de Categorias</div>
                <div class="stat-value">{{ count($labels) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Total de Pratos</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Categoria Maior</div>
                <div class="stat-value">{{ max($valores) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Média</div>
                <div class="stat-value">{{ round($total / count($labels), 1) }}</div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chartPratos').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Quantidade de Pratos',
                    data: {!! json_encode($valores) !!},
                    backgroundColor: {!! json_encode($cores) !!},
                    borderColor: '#fff',
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 12
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
