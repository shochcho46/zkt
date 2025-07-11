
<!-- Navigation (optional) -->
        <nav class="navbar navbar-expand-lg navbar bg-white fixed-top shadow-md">
            <div class="container">
                <a class="navbar-brand" href="#">
                   <img src="{{ asset('attensy.png') }}" alt="Attensy Logo" class="brand-image">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#how-it-works">How It Works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('adminLogin') }}">Login</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
