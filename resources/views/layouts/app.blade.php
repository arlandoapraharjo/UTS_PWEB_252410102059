<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="@yield('body_class', 'app-body')">
    <!-- Freddy Fazbear Static Background -->
    <x-background />

    <div class="app">
        @hasSection('hideNav')
            <!-- Login: Centered / Left terminal frame -->
            <main class="main main--full">
                @yield('content')
            </main>
        @else
            <!-- Authenticated App Shell: Left Sidebar & Content Panel -->
            <div class="app-shell">
                <x-navbar :username="$username ?? request('username')" />
                <main class="main main--content">
                    @yield('content')
                </main>
            </div>
            <x-footer />
        @endif
    </div>
</body>
</html>
