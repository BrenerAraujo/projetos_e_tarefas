<div class="container">
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="brand">
            <i class="fas fa-tasks"></i>
            {{ env('APP_NAME') }}
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Projetos</a></li>
            <li><a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">Tarefas</a></li>
        </ul>
    </nav>
</div>
