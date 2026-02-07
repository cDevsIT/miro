<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @viteReactRefresh
    @vite(['resources/css/admin.css', 'resources/js/app.jsx'])
    @stack('scripts')
    <script>
        // Generic toggle handler used both in sidebar (products dropdown)
        // and in admin forms (product sections, blog sections, etc.)
        function toggleSection(sectionId) {
            const content = document.getElementById(`${sectionId}-content`);
            const icon = document.getElementById(`${sectionId}-icon`);

            if (!content) {
                return;
            }

            const isSidebarDropdown = content.classList.contains('dropdown-content');
            const isToggleContent = content.classList.contains('toggle-content');

            if (isSidebarDropdown) {
                // Sidebar dropdown (Products group) – use CSS class only
                if (content.classList.contains('show')) {
                    content.classList.remove('show');
                    if (icon) icon.classList.remove('rotated');
                } else {
                    content.classList.add('show');
                    if (icon) icon.classList.add('rotated');
                }
            } else if (isToggleContent) {
                // Form sections – be robust even if other CSS interferes
                const currentDisplay = window.getComputedStyle(content).display;
                const isHidden = currentDisplay === 'none';

                if (isHidden) {
                    content.style.display = 'block';
                    content.classList.add('show');
                    if (icon) icon.classList.add('rotated');
                } else {
                    content.style.display = 'none';
                    content.classList.remove('show');
                    if (icon) icon.classList.remove('rotated');
                }
            } else {
                // Fallback: simple class toggle
                if (content.classList.contains('show')) {
                    content.classList.remove('show');
                    if (icon) icon.classList.remove('rotated');
                } else {
                    content.classList.add('show');
                    if (icon) icon.classList.add('rotated');
                }
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(event) {
                const navGroup = document.querySelector('.nav-group');
                const productsContent = document.getElementById('products-content');
                const productsIcon = document.getElementById('products-icon');
                
                // Check if click is outside the nav-group
                if (navGroup && !navGroup.contains(event.target)) {
                    if (productsContent && productsContent.classList.contains('show')) {
                        productsContent.classList.remove('show');
                        if (productsIcon) {
                            productsIcon.classList.remove('rotated');
                        }
                    }
                }
            });

            // Initialize Bootstrap dropdowns manually
            if (typeof $ !== 'undefined') {
                $('.dropdown-toggle').dropdown();
                
                // Debug click handlers
                $('#notificationDropdown').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).next('.dropdown-menu').toggle();
                });

                $('#userMenuDropdown').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).next('.dropdown-menu').toggle();
                });

                // Close dropdowns when clicking outside
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.dropdown').length) {
                        $('.dropdown-menu').hide();
                    }
                });

                // Prevent dropdown from closing when clicking inside
                $('.dropdown-menu').on('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
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
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <span>Dashboard</span>
                </a>
                
                <!-- Add Products dropdown -->
                <div class="nav-group">
                    <div class="nav-item dropdown" onclick="toggleSection('products')">
                        <span>Products</span>
                        <i class="fas fa-chevron-down" id="products-icon"></i>
                    </div>
                    <div class="dropdown-content" id="products-content">
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

                <a href="{{ route('admin.insights') }}" class="nav-item">
                    <span>Insights</span>
                </a>
                <a href="{{ route('admin.customers.index') }}" class="nav-item">
                    <span>Customers</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-item">
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="nav-item">
                    <span>Blogs</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <span>Settings</span>
                </a>
                <a href="{{ route('admin.activity.index') }}" class="nav-item">
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
                    <!-- Notifications Dropdown -->
                    <div class="dropdown notification-dropdown">
                        <button class="notification-btn" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            @php
                                $unreadCount = App\Models\Message::where('read_status', 0)->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="notification-badge">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-right notification-menu" aria-labelledby="notificationDropdown">
                            <div class="dropdown-header">
                                <strong>Notifications</strong>
                                @if($unreadCount > 0)
                                    <span class="badge badge-danger ml-2">{{ $unreadCount }}</span>
                                @endif
                            </div>
                            <div class="dropdown-divider"></div>
                            @php
                                $recentNotifications = App\Models\Message::with('customer')
                                    ->where('read_status', 0)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            @forelse($recentNotifications as $notification)
                                <a href="{{ route('admin.insights.message', $notification->id) }}" class="dropdown-item notification-item">
                                    <div class="d-flex">
                                        <i class="fas fa-envelope text-info mr-2 mt-1"></i>
                                        <div class="flex-grow-1">
                                            <strong>{{ $notification->subject }}</strong>
                                            <p class="mb-0 small text-muted">{{ $notification->customer ? $notification->customer->name : 'Guest' }}</p>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="dropdown-item text-center py-3">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <p class="text-muted mb-0">No new notifications</p>
                                </div>
                            @endforelse
                            @if($unreadCount > 0)
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.insights.messages') }}" class="dropdown-item text-center text-primary">
                                    <strong>View All Messages</strong>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- User Menu Dropdown -->
                    <div class="dropdown user-dropdown">
                        <button class="user-menu-btn" id="userMenuDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name d-none d-md-inline ml-2">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right user-menu-dropdown" aria-labelledby="userMenuDropdown">
                            <div class="dropdown-header">
                                <strong>{{ Auth::user()->name }}</strong>
                                <p class="mb-0 small text-muted">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            <a href="{{ route('admin.settings') }}" class="dropdown-item">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <a href="{{ route('admin.activity.index') }}" class="dropdown-item">
                                <i class="fas fa-history mr-2"></i> Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" class="dropdown-logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
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