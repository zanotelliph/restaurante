<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .header {
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            color: #667eea;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .stat-box {
            background: #f5f5f5;
            padding: 15px;
            border-left: 4px solid #667eea;
        }

        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid #667eea;
        }

        td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f0f0f0;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 10px;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>RELATÓRIO DE CLIENTES</h1>
        <p><strong>Data de Emissão:</strong> {{ date('d/m/Y H:i:s') }}</p>
        <p><strong>Restaurante:</strong> Sistema de Gestão</p>
    </div>

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
            @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->email ?? '-' }}</td>
                <td>{{ $cliente->telefone ?? '-' }}</td>
                <td>{{ $cliente->cpf ?? '-' }}</td>
                <td>{{ $cliente->pedidos_count }}</td>
                <td>{{ $cliente->reservas_count }}</td>
                <td>R$ {{ number_format($cliente->total_gasto, 2, ',', '.') }}</td>
                <td>
                    @if($cliente->total_gasto >= 1000)
                        <span class="badge badge-gold">VIP</span>
                    @elseif($cliente->total_gasto >= 500)
                        <span class="badge badge-silver">Premium</span>
                    @elseif($cliente->pedidos_count > 5)
                        <span class="badge badge-bronze">Ativo</span>
                    @else
                        Novo
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 20px;">Nenhum cliente encontrado</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Relatório gerado automaticamente em {{ date('d/m/Y às H:i:s') }}</p>
        <p>© 2026 Sistema de Gestão de Restaurante. Todos os direitos reservados.</p>
    </div>
</body>
</html>
