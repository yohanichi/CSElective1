<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'School Management System')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: #fafbfc;
            min-height: 100vh;
            color: #2d3748;
        }

        .navbar {
            background: #ffffff;
            color: #2d3748;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .navbar-nav {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex: 1;
            justify-content: center;
        }

        .navbar-nav a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-block;
        }

        .navbar-nav a:hover:not(.active) {
            background: #f0f4f8;
            color: #4338ca;
        }

        .navbar-nav a.active {
            background: #4f46e5;
            color: white;
            cursor: default;
            pointer-events: none;
        }

        .navbar-nav a.active:hover {
            background: #4f46e5;
        }

        .navbar .logo {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a202c;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.95rem;
        }

        .navbar .logout-btn {
            background: #f56565;
            color: white;
            padding: 0.6rem 1.25rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar .logout-btn:hover {
            background: #e53e3e;
            box-shadow: 0 4px 12px rgba(245, 101, 101, 0.25);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem;
        }

        .alert {
            padding: 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: none;
            font-weight: 500;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-left: 4px solid #22c55e;
        }

        .alert-danger,
        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.75rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
        }

        .btn-primary:hover {
            background: #4338ca;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #9ca3af;
            color: white;
        }

        .btn-secondary:hover {
            background: #6b7280;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #f56565;
            color: white;
        }

        .btn-danger:hover {
            background: #e53e3e;
            box-shadow: 0 4px 12px rgba(245, 101, 101, 0.3);
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.7rem;
            font-weight: 600;
            color: #1a202c;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-group small {
            display: block;
            margin-top: 0.4rem;
            color: #718096;
            font-size: 0.85rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .table th,
        .table td {
            padding: 1.25rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .table th {
            background: #f8fafc;
            font-weight: 700;
            color: #1a202c;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .actions {
            display: flex;
            gap: 0.75rem;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #f0f4f8;
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a202c;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            margin-bottom: 2rem;
        }

        .grid-item {
            background: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .grid-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .grid-item h3 {
            color: #1a202c;
            margin-bottom: 1rem;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .grid-item p {
            color: #718096;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .grid-item .btn {
            margin: 0.25rem;
        }

        .text-center {
            text-align: center;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .mt-3 {
            margin-top: 1.5rem;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1a202c;
        }

        h1 + p {
            color: #718096;
            font-size: 1.1rem;
        }

        .user-dropdown {
            position: relative;
        }

        .user-menu-trigger {
            cursor: pointer;
            color: #4f46e5;
            font-weight: 600;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .user-menu-trigger:hover {
            background: #f0f4f8;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            margin-top: 0.5rem;
            display: none;
            z-index: 1000;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu form {
            display: block;
        }

        .dropdown-menu a {
            padding: 0.85rem 1.25rem;
            color: #2d3748;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #e2e8f0;
        }

        .dropdown-menu a:last-child,
        .dropdown-menu form:last-child {
            border-bottom: none;
        }

        .dropdown-menu a:hover {
            background: #f8fafc;
            color: #4f46e5;
            padding-left: 1.5rem;
        }

        .dropdown-menu form {
            padding: 0;
        }

        .dropdown-menu button {
            width: 100%;
            padding: 0.85rem 1.25rem;
            background: none;
            border: none;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            cursor: pointer;
            color: #2d3748;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-menu button:last-child {
            border-bottom: none;
        }

        .dropdown-menu button:hover {
            background: #f8fafc;
            color: #f56565;
            padding-left: 1.5rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    @if(Auth::check())
    <nav class="navbar">
        <div class="container">
            <div class="logo">School Management System</div>
            <div class="navbar-nav">
                <a href="{{ route('subjects.index') }}" class="@if(Route::currentRouteName() === 'subjects.index') active @endif">Subjects</a>
                <a href="{{ route('programs.index') }}" class="@if(Route::currentRouteName() === 'programs.index') active @endif">Programs</a>
                @if(Auth::user()->isAdmin())
                <a href="{{ route('users.index') }}" class="@if(Route::currentRouteName() === 'users.index') active @endif">Users</a>
                @endif
            </div>
            <div class="user-info">
                <div class="user-dropdown">
                    <div class="user-menu-trigger" id="userMenuTrigger">
                        <span>{{ Auth::user()->username }}</span>
                        <span>▼</span>
                    </div>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('password.edit') }}">Change Password</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trigger = document.getElementById('userMenuTrigger');
            const menu = document.getElementById('dropdownMenu');

            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('active');
            });

            document.addEventListener('click', function(e) {
                if (!trigger.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('active');
                }
            });
        });
    </script>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>