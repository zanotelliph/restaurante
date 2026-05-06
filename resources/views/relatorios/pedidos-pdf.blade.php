<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Pedidos</title>
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

        .status-ativo {
            background: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
        }

        .status-pendente {
            background: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
        }

        .status-cancelado {
            background: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RELATÓRIO DE PEDIDOS</h1>
        <p><strong>Data de Emissão:</strong> {{ date('d/m/Y H:i:s') }}</p>
        <p><strong>Restaurante:</strong> Sistema de Gestão</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <div class="stat-label">Total de Pedidos</div>
            <div class="stat-value">{{ $totalPedidos }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Total de Vendas</div>
            <div class="stat-value">R$ {{ number_format($totalVendas, 2, ',', '.') }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Média por Pedido</div>
            <div class="stat-value">R$ {{ number_format($mediaVendas, 2, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Status</th>
                <th>Data</th>
                <th>Itens</th>
                <th>Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $pedido)
            <tr>
                <td>#{{ $pedido->id }}</td>
                <td>{{ $pedido->cliente->nome ?? 'N/A' }}</td>
                <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                <td>
                    @if($pedido->status === 'concluido')
                        <span class="status-ativo">Concluído</span>
                    @elseif($pedido->status === 'pendente')
                        <span class="status-pendente">Pendente</span>
                    @else
                        <span class="status-cancelado">{{ ucfirst($pedido->status) }}</span>
                    @endif
                </td>
                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                <td>{{ $pedido->itens->count() }} item(ns)</td>
                <td>
                    @if($pedido->pagamento)
                        {{ ucfirst($pedido->pagamento->metodo ?? 'N/A') }}
                    @else
                        Não realizado
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">Nenhum pedido encontrado</td>
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
