@props([
    'username' => request('username')
])

<aside class="nav-sidebar">
    <!-- Brand / Title at Top Left (FNAF Main Menu Style) -->
    <div class="nav-sidebar__brand">
        <a href="{{ $username ? route('dashboard', ['username' => $username]) : route('login') }}" class="nav-sidebar__logo">
            <span class="fnaf-title-line">5 Malam</span>
            <span class="fnaf-title-line fnaf-accent">Haur Haur</span>
        </a>
    </div>

    <!-- Mobile navigation toggle -->
    <input type="checkbox" id="nav-toggle" class="nav-toggle-input" aria-label="Toggle menu" />
    <label for="nav-toggle" class="nav-toggle-burger" aria-label="Toggle navigation">
        <span class="burger-bar"></span>
        <span class="burger-bar"></span>
        <span class="burger-bar"></span>
    </label>

    <!-- Vertical Left Sidebar Menu with FNAF >> Selector -->
    <nav class="nav-sidebar__menu">
        <div class="nav-sidebar__links">
            <a href="{{ route('dashboard', ['username' => $username]) }}"
               class="nav-sidebar__link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-arrow">&gt;&gt;</span>
                <span class="nav-label">Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}"
               class="nav-sidebar__link {{ request()->routeIs('pengelolaan') ? 'active' : '' }}">
                <span class="nav-arrow">&gt;&gt;</span>
                <span class="nav-label">Management</span>
            </a>
            <a href="{{ route('profile', ['username' => $username]) }}"
               class="nav-sidebar__link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <span class="nav-arrow">&gt;&gt;</span>
                <span class="nav-label">Profile</span>
            </a>
            <a href="{{ route('login') }}" class="nav-sidebar__link nav-sidebar__link--logout">
                <span class="nav-arrow">&gt;&gt;</span>
                <span class="nav-label">Logout</span>
            </a>
        </div>
    </nav>
</aside>
