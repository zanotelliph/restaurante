<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ config('restaurant.name') }} - Sistema de Pedidos</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary-blue: #0066CC;
    --secondary-blue: #0052A3;
    --light-blue: #E6F0FF;
    --dark-blue: #003D7A;
    --accent-blue: #0099FF;
    --text-dark: #1a1a1a;
    --text-light: #ffffff;
    --border-color: #d0d8e0;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #e8f0f8 100%);
    min-height: 100vh;
}

/* Navbar */
.navbar-custom {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%) !important;
    box-shadow: 0 4px 15px rgba(0, 102, 204, 0.25);
    border-bottom: 3px solid var(--accent-blue);
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.8rem;
    color: var(--text-light) !important;
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: transform 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05);
}

.nav-link {
    color: rgba(255, 255, 255, 0.85) !important;
    font-weight: 600;
    font-size: 1.1rem;
    padding: 0.75rem 1.5rem !important;
    margin: 0 0.25rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    bottom: 0;
    left: 50%;
    background-color: var(--accent-blue);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover {
    color: var(--text-light) !important;
    background-color: rgba(255, 255, 255, 0.15);
}

.nav-link:hover::after {
    width: 80%;
}

.nav-link.active {
    background-color: var(--accent-blue) !important;
    color: var(--text-light) !important;
    box-shadow: 0 4px 10px rgba(0, 153, 255, 0.3);
}

/* Container Principal */
.container {
    max-width: 1200px;
}

.main-container {
    background: var(--text-light);
    border-radius: 1rem;
    box-shadow: 0 8px 32px rgba(0, 102, 204, 0.12);
    border: 1px solid rgba(0, 102, 204, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.main-container:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(0, 102, 204, 0.15);
}

.page-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.page-header h1,
.page-header h2 {
    margin-bottom: 0.5rem;
}

.page-header p {
    color: #556b88;
    margin-bottom: 0;
}

.action-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    align-items: center;
    justify-content: flex-end;
}

/* Títulos */
h1, h2, h3, h4, h5, h6 {
    color: var(--dark-blue);
    font-weight: 700;
}

/* Botões */
.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%) !important;
    border: none;
    color: var(--text-light) !important;
    font-weight: 600;
    padding: 0.65rem 1.5rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 102, 204, 0.25);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 102, 204, 0.35);
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    border: none;
    color: var(--text-light) !important;
    font-weight: 600;
    padding: 0.65rem 1.5rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(40, 167, 69, 0.25);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(40, 167, 69, 0.35);
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%) !important;
    border: none;
    color: var(--text-light) !important;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(220, 53, 69, 0.35);
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
    border: none;
    color: var(--text-light) !important;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(108, 117, 125, 0.35);
}

.btn-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%) !important;
    border: none;
    color: var(--text-dark) !important;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.btn-info {
    background: linear-gradient(135deg, var(--accent-blue) 0%, var(--primary-blue) 100%) !important;
    border: none;
    color: var(--text-light) !important;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

/* Cards */
.card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0, 102, 204, 0.1);
    border-top: 4px solid var(--primary-blue);
    transition: all 0.3s ease;
    background: var(--text-light);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 102, 204, 0.15);
}

.card-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%) !important;
    color: var(--text-light) !important;
    font-weight: 700;
    border-radius: 0.85rem 0.85rem 0 0 !important;
    padding: 1rem !important;
    border: none !important;
}

.card-body {
    padding: 1.5rem;
}

/* Tabelas */
.table {
    border-collapse: separate;
    border-spacing: 0;
}

.table thead {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    color: var(--text-light);
    font-weight: 700;
}

.table thead th {
    border: none;
    padding: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}

.table tbody tr {
    border-bottom: 1px solid var(--border-color);
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: var(--light-blue);
    box-shadow: inset 0 0 10px rgba(0, 102, 204, 0.08);
}

.table td {
    padding: 1rem;
    vertical-align: middle;
    color: var(--text-dark);
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(230, 240, 255, 0.3);
}

/* Formulários */
.form-label {
    color: var(--dark-blue);
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.form-control, .form-select {
    border: 2px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    color: var(--text-dark);
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-blue) !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25) !important;
    background-color: rgba(230, 240, 255, 0.5);
}

.form-control::placeholder {
    color: #999;
}

/* Badges */
.badge {
    padding: 0.65rem 1rem;
    font-weight: 600;
    border-radius: 0.5rem;
    font-size: 0.9rem;
}

.badge.bg-info {
    background: linear-gradient(135deg, var(--accent-blue) 0%, var(--primary-blue) 100%) !important;
}

.badge.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
}

.badge.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%) !important;
    color: var(--text-dark) !important;
}

.badge.bg-danger {
    background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%) !important;
}

/* Alerts */
.alert {
    border: none;
    border-left: 4px solid;
    border-radius: 0.5rem;
    font-weight: 500;
}

.alert-info {
    background-color: rgba(230, 240, 255, 0.8);
    border-left-color: var(--primary-blue);
    color: var(--dark-blue);
}

.alert-success {
    background-color: rgba(40, 167, 69, 0.1);
    border-left-color: #28a745;
    color: #155724;
}

.alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border-left-color: #dc3545;
    color: #721c24;
}

/* Modal */
.modal-content {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    color: var(--text-light);
    border: none;
    border-radius: 1rem 1rem 0 0;
    font-weight: 700;
}

.modal-footer {
    border: none;
    padding: 1.5rem;
}

/* Padding e Margin */
.mt-5 {
    margin-top: 2rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.p-4 {
    padding: 2rem !important;
}

/* Responsive */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.3rem;
    }
    
    .nav-link {
        font-size: 1rem;
        padding: 0.5rem 1rem !important;
    }
    
    .container {
        padding: 1rem;
    }
}
</style>

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
<div class="container">

<a class="navbar-brand" href="/" title="{{ config('restaurant.tagline') }}">
🍽 {{ config('restaurant.name') }}
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">
<div class="navbar-nav ms-auto">

<a class="nav-link {{ request()->is('cliente') ? 'active' : '' }}" href="/cliente">Clientes</a>

<a class="nav-link {{ request()->is('pratos') ? 'active' : '' }}" href="/pratos">Pratos</a>

<a class="nav-link {{ request()->is('pedido') ? 'active' : '' }}" href="/pedido">Pedidos</a>

<a class="nav-link {{ request()->is('graficos*') ? 'active' : '' }}" href="{{ route('grafico.clientes-pedidos') }}">📊 Gráficos</a>

<a class="nav-link {{ request()->is('relatorios*') ? 'active' : '' }}" href="{{ route('relatorio.pedidos') }}">📄 Relatórios</a>

<a class="nav-link {{ request()->is('reserva*') ? 'active' : '' }}" href="/reserva">Reservas</a>

<a class="nav-link {{ request()->is('pagamento*') ? 'active' : '' }}" href="/pagamento">Pagamentos</a>

<a class="nav-link {{ request()->is('estoque') ? 'active' : '' }}" href="/estoque">Estoque</a>

</div>
</div>

</div>
</nav>

<!-- Conteúdo -->
<div class="container mt-5 mb-5">

<div class="main-container p-5">

@include('partials.dashboard-cards')

@yield('conteudo')

</div>

</div>

</body>
</html>