<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico - Quantidade de Pedidos por Cliente</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Gráfico de Barras</h1>
        <p class="subtitle">Quantidade de Pedidos por Cliente (Top 10)</p>

        <div class="chart-wrapper">
            <canvas id="chartClientes"></canvas>
        </div>

        <div class="actions">
            <a href="{{ route('grafico.pratos-categoria') }}" class="btn">Ver Gráfico de Pizza</a>
            <a href="{{ route('relatorio.pedidos') }}" class="btn btn-secondary">Relatório de Pedidos</a>
            <a href="{{ route('relatorio.clientes') }}" class="btn btn-secondary">Relatório de Clientes</a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
        </div>

        <div class="stats">
            <div class="stat-box">
                <div class="stat-label">Total de Dados</div>
                <div class="stat-value">{{ count($labels) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Maior Valor</div>
                <div class="stat-value">{{ max($valores) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Menor Valor</div>
                <div class="stat-value">{{ min($valores) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Média</div>
                <div class="stat-value">{{ round(array_sum($valores) / count($valores), 1) }}</div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chartClientes').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Quantidade de Pedidos',
                    data: {!! json_encode($valores) !!},
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.7)',
                        'rgba(118, 75, 162, 0.7)',
                        'rgba(52, 211, 153, 0.7)',
                        'rgba(249, 115, 22, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(14, 165, 233, 0.7)',
                        'rgba(251, 146, 60, 0.7)',
                        'rgba(34, 197, 94, 0.7)'
                    ],
                    borderColor: [
                        'rgba(102, 126, 234, 1)',
                        'rgba(118, 75, 162, 1)',
                        'rgba(52, 211, 153, 1)',
                        'rgba(249, 115, 22, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(14, 165, 233, 1)',
                        'rgba(251, 146, 60, 1)',
                        'rgba(34, 197, 94, 1)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(102, 126, 234, 0.9)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
