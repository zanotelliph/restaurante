<div class="row mb-5 dashboard-section">
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-users" style="font-size: 2.5rem; color: #0066CC;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Clientes</h5>
                <p class="display-5 fw-bold text-primary">{{ $clientesCount ?? 0 }}</p>
                <a href="{{ route('cliente.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-right"></i> Gerenciar
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-clipboard-list" style="font-size: 2.5rem; color: #0099FF;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Pedidos</h5>
                <p class="display-5 fw-bold" style="color: #0099FF;">{{ $pedidosCount ?? 0 }}</p>
                <a href="{{ route('pedido.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-arrow-right"></i> Gerenciar
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-box" style="font-size: 2.5rem; color: #20c997;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Estoque</h5>
                <p class="display-5 fw-bold" style="color: #20c997;">{{ $estoqueCount ?? 0 }}</p>
                <a href="{{ route('estoque.index') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-right"></i> Gerenciar
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-calendar-check" style="font-size: 2.5rem; color: #6610f2;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Reservas</h5>
                <p class="display-5 fw-bold" style="color: #6610f2;">{{ $reservasCount ?? 0 }}</p>
                <a href="{{ route('reserva.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-right"></i> Acessar
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-credit-card" style="font-size: 2.5rem; color: #6610f2;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Pagamentos</h5>
                <p class="display-5 fw-bold" style="color: #6610f2;">{{ $pagamentosCount ?? 0 }}</p>
                <a href="{{ route('pagamento.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-right"></i> Acessar
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-chart-bar" style="font-size: 2.5rem; color: #6610f2;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Gráficos</h5>
                <p class="display-5 fw-bold" style="color: #6610f2;">📊</p>
                <a href="{{ route('grafico.clientes-pedidos') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-right"></i> Acessar
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-file-alt" style="font-size: 2.5rem; color: #20c997;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Relatórios</h5>
                <p class="display-5 fw-bold" style="color: #20c997;">📄</p>
                <a href="{{ route('relatorios.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-right"></i> Acessar
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-box mb-3">
                    <i class="fas fa-home" style="font-size: 2.5rem; color: #ffc107;"></i>
                </div>
                <h5 class="card-title text-uppercase fw-bold">Dashboard</h5>
                <p class="display-5 fw-bold" style="color: #ffc107;">📊</p>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-arrow-right"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-section {
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dashboard-card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0, 102, 204, 0.1);
    border-top: 5px solid var(--primary-blue);
    transition: all 0.3s ease;
    background: var(--text-light);
}

.dashboard-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0, 102, 204, 0.2);
}

.dashboard-card .card-title {
    color: var(--dark-blue);
    font-size: 0.95rem;
    letter-spacing: 1px;
}

.dashboard-card .display-5 {
    margin: 1rem 0;
    font-size: 2.5rem;
}

.icon-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(0, 102, 204, 0.1), rgba(0, 153, 255, 0.1));
}
</style>
