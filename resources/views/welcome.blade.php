<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BurgerIpp - Livraison de Burgers</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            min-height: 100vh;
            color: #2d3436;
        }

        /* Navbar moderne */
        .modern-navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: none;
            box-shadow: 0 8px 32px rgba(255, 65, 108, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 12px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: #ff416c !important;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand:hover {
            color: #ff4757 !important;
            text-decoration: none;
        }

        .brand-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #ff416c, #ff4757);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }

        .nav-link {
            color: #2d3436 !important;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 10px 16px !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin: 0 4px;
        }

        .nav-link:hover {
            background: rgba(255, 65, 108, 0.1);
            color: #ff416c !important;
            transform: translateY(-1px);
        }

        .nav-link.active {
            background: rgba(255, 65, 108, 0.15);
            color: #ff416c !important;
        }

        .navbar-toggler {
            border: none;
            background: rgba(255, 65, 108, 0.1);
            border-radius: 10px;
            padding: 8px 10px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.2);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23ff416c' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Boutons d'authentification */
        .auth-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-auth {
            background: linear-gradient(135deg, #ff416c, #ff4757);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 65, 108, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-auth.btn-outline {
            background: transparent;
            color: #ff416c;
            border: 2px solid rgba(255, 65, 108, 0.3);
            box-shadow: none;
        }

        .btn-auth.btn-outline:hover {
            background: #ff416c;
            color: white;
            border-color: #ff416c;
        }

        /* Dropdown utilisateur */
        .user-dropdown {
            position: relative;
        }

        .user-info {
            background: rgba(255, 65, 108, 0.1);
            border: 2px solid rgba(255, 65, 108, 0.2);
            border-radius: 12px;
            padding: 8px 16px;
            color: #ff416c;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-info:hover {
            background: rgba(255, 65, 108, 0.15);
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #ff416c, #ff4757);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        /* Contenu principal */
        .main-content {
            min-height: calc(100vh - 100px);
            padding: 0;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-nav {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 16px;
                padding: 20px;
                margin-top: 15px;
                box-shadow: 0 8px 32px rgba(255, 65, 108, 0.2);
            }

            .nav-link {
                padding: 12px 16px !important;
                margin: 4px 0;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                margin-top: 15px;
            }

            .btn-auth {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .brand-icon {
                width: 30px;
                height: 30px;
                font-size: 16px;
            }
        }

        /* Animations d'entrée */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Messages d'alerte modernes */
        .alert {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin: 20px 15px;
        }

        .alert-success {
            border-left: 4px solid #00b894;
            color: #00b894;
        }

        .alert-danger {
            border-left: 4px solid #e74c3c;
            color: #e74c3c;
        }

        .alert-info {
            border-left: 4px solid #0984e3;
            color: #0984e3;
        }
    </style>
</head>
<body>

<!-- Navigation moderne -->
<nav class="navbar navbar-expand-lg modern-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('burger') }}">
            <div class="brand-icon">🍔</div>
            BurgerIpp
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('burger') }}">Burgers</a>
                </li>

                @if(Auth::check() && Auth::user()->role === 'gestionnaire')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('commande') }}">Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('statistiques') }}">Statistiques</a>
                    </li>
                @endif

                @if(Auth::check() && Auth::user()->role === 'client')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.show') }}">Mon Panier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('facture') }}">Mes Factures</a>
                    </li>
                @endif
            </ul>

            <!-- Section authentification -->
            <div class="auth-buttons">
                @if(Auth::check())
                    <div class="user-dropdown dropdown">
                        <div class="user-info dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    Mon Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-auth btn-outline">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn-auth">
                        Inscription
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<div class="main-content fade-in-up">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Animation d'entrée pour les éléments
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.fade-in-up');
    elements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
});

// Gestion du dropdown utilisateur
document.addEventListener('click', function(e) {
    const dropdowns = document.querySelectorAll('.dropdown-menu');
    dropdowns.forEach(dropdown => {
        if (!dropdown.closest('.dropdown').contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
});
</script>

</body>
</html>
