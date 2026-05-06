<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Clientes</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
        }

        .header h1 {
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .stat-label {
            color: #666;
            font-size: 13px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-value {
            color: #667eea;
            font-size: 28px;
            font-weight: bold;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8f9fa;
            color: #333;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #667eea;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
        }

        .badge-gold {
            background: #ffd700;
            color: #333;
        }

        .badge-silver {
            background: #c0c0c0;
            color: #333;
        }

        .badge-bronze {
            background: #cd7f32;
            color: white;
        }

        .badge-novo {
            background: #e2e3e5;
            color: #333;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            border-top: 1px solid #eee;
            text-align: center;
            color: #666;
            font-size: 12px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state p {
            margin-bottom: 20px;
        }

        .print-button {
            background-color: #28a745;
        }

        .print-button:hover {
            background-color: #218838;
        }

        @media print {
            body {
                background: white;
            }

            .actions,
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👥 Relatório de Clientes</h1>
            <p>Gerado em {{ date('d/m/Y H:i:s') }}</p>
        </div>

        <div class="content">
            <div class="stats">
                <div class="stat-box">
                    <div class="stat-label">Total de Clientes</div>
                    <div class="stat-value">{{ $totalClientes }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Gasto</div>
                    <div class="stat-value">R$ {{ number_format($totalGasto, 2, ',', '.') }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Média por Cliente</div>
                    <div class="stat-value">R$ {{ number_format($mediaGasto, 2, ',', '.') }}</div>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('relatorio.clientes.pdf') }}" class="btn print-button">⬇️ Baixar PDF</a>
                <a href="{{ route('relatorio.pedidos') }}" class="btn btn-secondary">Ver Pedidos</a>
                <a href="{{ route('grafico.clientes-pedidos') }}" class="btn btn-secondary">Ver Gráficos</a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar</a>
            </div>

            @if($clientes->count() > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>Pedidos</th>
                            <th>Reservas</th>
                            <th>Total Gasto</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td><strong>{{ $cliente->nome }}</strong></td>
                            <td>{{ $cliente->email ?? '-' }}</td>
                            <td>{{ $cliente->telefone ?? '-' }}</td>
                            <td>{{ $cliente->cpf ?? '-' }}</td>
                            <td>{{ $cliente->pedidos_count }}</td>
                            <td>{{ $cliente->reservas_count }}</td>
                            <td><strong>R$ {{ number_format($cliente->total_gasto, 2, ',', '.') }}</strong></td>
                            <td>
                                @if($cliente->total_gasto >= 1000)
                                    <span class="badge badge-gold">👑 VIP</span>
                                @elseif($cliente->total_gasto >= 500)
                                    <span class="badge badge-silver">⭐ Premium</span>
                                @elseif($cliente->pedidos_count > 5)
                                    <span class="badge badge-bronze">🔥 Ativo</span>
                                @else
                                    <span class="badge badge-novo">🆕 Novo</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <p>📭 Nenhum cliente encontrado</p>
                <a href="{{ route('cliente.create') }}" class="btn">Criar Novo Cliente</a>
            </div>
            @endif
        </div>

        <div class="footer">
            <p>© 2026 Sistema de Gestão de Restaurante. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
