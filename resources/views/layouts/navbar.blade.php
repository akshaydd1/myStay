<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">HotelBooking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Rooms</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Facilities</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                @if (!session('student_id'))
                    <li class="nav-item"><a class="nav-link {{ request()->is('registration') ? 'active' : '' }}" href="{{ route('registration') }}">Registration</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Log in</a></li>
                @else
                    <li class="nav-item"><a class="nav-link {{ request()->is('dashboard') || request()->is('admin_dashboard') ? 'active' : '' }}" href="{{ session('is_admin') ? url('admin_dashboard') : url('dashboard') }}">Dashboard</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
