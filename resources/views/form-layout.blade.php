<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('restaurant.name') }} - Formulário</title>

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
            --accent-blue: #0099FF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar minimalista */
        .navbar-form {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.25);
            border-bottom: 3px solid var(--accent-blue);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-form .brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-form .brand:hover {
            color: var(--accent-blue);
            text-decoration: none;
        }

        /* Container principal */
        .form-container {
            flex: 1;
            display: flex;
            align-items: stretch;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        /* Conteúdo */
        main {
            flex: 1;
            width: 100%;
            overflow: auto;
            padding: 0;
            margin: 0;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .navbar-form {
                padding: 1rem;
            }

            .navbar-form .brand {
                font-size: 1.2rem;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- Navbar Minimalista -->
    <nav class="navbar-form">
        <a href="{{ route('dashboard') }}" class="brand">
            <i class="fas fa-utensils"></i>
            {{ config('restaurant.name') ?? 'Restaurante' }}
        </a>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="form-container">
        <main>
            @yield('conteudo')
        </main>
    </div>

    @yield('scripts')
</body>

</html>
