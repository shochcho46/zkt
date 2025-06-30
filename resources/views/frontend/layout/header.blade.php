
<!-- Navigation (optional) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-md">
            <div class="container">
                <a class="navbar-brand" href="#">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100" width="150">
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#3a7bd5;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#00d2ff;stop-opacity:1" />
                            </linearGradient>
                        </defs>

                        <!-- Main checkmark shape -->
                        <path d="M50,60 L90,90 L150,30" 
                                stroke="url(#gradient)" 
                                stroke-width="10" 
                                fill="none" 
                                stroke-linecap="round" 
                                stroke-linejoin="round"/>

                        <!-- Nodes representing points in a system -->
                        <circle cx="50" cy="60" r="8" fill="#3a7bd5" />
                        <circle cx="90" cy="90" r="8" fill="#00d2ff" />
                        <circle cx="150" cy="30" r="8" fill="#3a7bd5" />

                        <!-- Connecting dynamic lines (network/data flow) -->
                        <path d="M150,30 L210,70" stroke="url(#gradient)" stroke-width="6" stroke-linecap="round" />
                        <circle cx="210" cy="70" r="7" fill="url(#gradient)" />

                        <path d="M90,90 L130,90" stroke="url(#gradient)" stroke-width="6" stroke-linecap="round" />
                        <circle cx="130" cy="90" r="7" fill="url(#gradient)" />

                        <path d="M130,90 L170,50" stroke="url(#gradient)" stroke-width="6" stroke-linecap="round" />
                        <circle cx="170" cy="50" r="7" fill="url(#gradient)" />
                    </svg>

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
                            <a class="nav-link" href="admin/login">Login</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>