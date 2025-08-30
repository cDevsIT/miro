<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    @viteReactRefresh
    @vite(['resources/css/admin.css', 'resources/js/app.jsx'])
    @stack('scripts')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleSection(sectionId) {
            const content = document.getElementById(`${sectionId}-content`);
            const icon = document.getElementById(`${sectionId}-icon`);
            
            // Check if content is currently hidden (either by CSS or inline style)
            const isHidden = content.style.display === 'none' || 
                           (content.style.display === '' && window.getComputedStyle(content).display === 'none');
            
            if (isHidden) {
                content.style.display = 'block';
                icon.classList.add('rotated');
            } else {
                content.style.display = 'none';
                icon.classList.remove('rotated');
            }
        }
    </script>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-header">
            <img src="{{ asset('images/miro-logo-white.png') }}" alt="Miro">
                <div class="admin-title">Admin Dashboard</div>
            </div>
            
            <nav class="sidebar-nav">
                <a href="/admin/dashboard" class="nav-item">
                    <span>Dashboard</span>
                </a>
                
                <!-- Add Products dropdown -->
                <div class="nav-group">
                    <div class="nav-item dropdown">
                        <span>Products</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-content">
                        <a href="/admin/products" class="nav-item">
                            <span>All Products</span>
                        </a>
                        <a href="/admin/categories" class="nav-item">
                            <span>Categories</span>
                        </a>
                        <a href="/admin/attributes" class="nav-item">
                            <span>Attributes</span>
                        </a>
                        <a href="/admin/colors" class="nav-item">
                            <span>Colors</span>
                        </a>
                        <a href="/admin/reflector-colors" class="nav-item">
                            <span>Reflector Colors</span>
                        </a>
                        <a href="/admin/dimension-options" class="nav-item">
                            <span>Dimension Options</span>
                        </a>
                        <a href="/admin/family-products" class="nav-item">
                            <span>Family Products</span>
                        </a>
                        <a href="/admin/accessories" class="nav-item">
                            <span>Accessories</span>
                        </a>
                        <a href="/admin/installation-methods" class="nav-item">
                            <span>Installation Methods</span>
                        </a>
                    </div>
                </div>

                <a href="/admin/navigation" class="nav-item">
                    <span>Navigation Menu</span>
                </a>
                <a href="/admin/insights" class="nav-item">
                    <span>Insights</span>
                </a>
                <a href="/admin/client" class="nav-item">
                    <span>Client Panel</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="/admin/settings" class="nav-item">
                    <span>Settings</span>
                </a>
                <a href="/admin/activity" class="nav-item">
                    <span>Activity Log</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="nav-item logout-btn">
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <div class="header-right">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                    <div class="user-menu">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </header>
            
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html> 