<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}" title="{{ config('restaurant.tagline') }}">
            🍽 {{ config('restaurant.name') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ms-auto">
                <a class="nav-link {{ request()->routeIs('cliente.*') ? 'active' : '' }}" href="{{ route('cliente.index') }}">Clientes</a>
                <a class="nav-link {{ request()->routeIs('prato.*') ? 'active' : '' }}" href="{{ route('prato.index') }}">Pratos</a>
                <a class="nav-link {{ request()->routeIs('pedido.*') ? 'active' : '' }}" href="{{ route('pedido.index') }}">Pedidos</a>
                <a class="nav-link {{ request()->routeIs('estoque.*') ? 'active' : '' }}" href="{{ route('estoque.index') }}">Estoque</a>
            </div>
        </div>
    </div>
</nav>
