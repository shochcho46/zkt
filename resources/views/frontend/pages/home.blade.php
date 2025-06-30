@extends('frontend.layout.app')

@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
@endpush

@section('content')
      
<!-- Hero Section -->
<section class="hero-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100" width="300" class="mb-4">
                    <!-- Your existing logo SVG code -->
                </svg>
                <h1 class="display-4 fw-bold mb-3">Smart Attendance Management</h1>
                <p class="lead mb-4">Seamlessly connect your ZKT biometric devices, monitor real-time attendance, and generate comprehensive reports with our powerful solution.</p>
                <div class="d-flex gap-3">
                    <a href="#features" class="btn btn-light btn-lg px-4">Explore Features</a>
                    <a href="/login" class="btn btn-outline-light btn-lg px-4">Login</a>
                </div>
            </div>
            <div class="col-lg-6 text-end">
                <svg width="600" height="270" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                    <style>
                        .background { fill: white; }
                        .bar { fill: #42A5F5; opacity: 0; transform-origin: bottom; }
                        .bar1 { animation: grow 1.2s ease-out forwards 0.5s; filter: drop-shadow(0 4px 6px rgba(66, 165, 245, 0.3)); }
                        .bar2 { animation: grow 1.2s ease-out forwards 0.7s; filter: drop-shadow(0 4px 6px rgba(66, 165, 245, 0.3)); }
                        .bar3 { animation: grow 1.2s ease-out forwards 0.9s; filter: drop-shadow(0 4px 6px rgba(66, 165, 245, 0.3)); }
                        .bar4 { animation: grow 1.2s ease-out forwards 1.1s; filter: drop-shadow(0 4px 6px rgba(66, 165, 245, 0.3)); }
                        .line { fill: none; stroke: #1976D2; stroke-width: 3; stroke-dasharray: 400; stroke-dashoffset: 400; animation: draw 2s ease-in-out forwards 0.5s; }
                        .dot { fill: #1976D2; r: 5; opacity: 0; }
                        .dot1 { animation: pulse 1.5s infinite 0.5s, fade 0.5s forwards 0.5s; }
                        .dot2 { animation: pulse 1.5s infinite 0.7s, fade 0.5s forwards 0.7s; }
                        .dot3 { animation: pulse 1.5s infinite 0.9s, fade 0.5s forwards 0.9s; }
                        .dot4 { animation: pulse 1.5s infinite 1.1s, fade 0.5s forwards 1.1s; }
                        .title { font-family: Arial, sans-serif; font-size: 20px; fill: #333; text-anchor: middle; opacity: 0; animation: fadeIn 1s forwards; }
                        @keyframes grow {
                        from { transform: scaleY(0); opacity: 0; }
                        to { transform: scaleY(1); opacity: 1; }
                        }
                        @keyframes draw {
                        to { stroke-dashoffset: 0; }
                        }
                        @keyframes fade {
                        to { opacity: 1; }
                        }
                        @keyframes pulse {
                        0% { r: 5; }
                        50% { r: 7; }
                        100% { r: 5; }
                        }
                        @keyframes fadeIn {
                        to { opacity: 1; }
                        }
                    </style>

                    <!-- Background -->
                    <rect class="background" x="0" y="0" width="400" height="300" />

                    <!-- Bars -->
                    <rect class="bar bar1" x="80" y="150" width="30" height="100" />
                    <rect class="bar bar2" x="140" y="100" width="30" height="150" />
                    <rect class="bar bar3" x="200" y="120" width="30" height="130" />
                    <rect class="bar bar4" x="260" y="80" width="30" height="170" />

                    <!-- Line Graph -->
                    <polyline class="line" points="50,200 120,150 190,100 260,150" />
                    <circle class="dot dot1" cx="50" cy="200" />
                    <circle class="dot dot2" cx="120" cy="150" />
                    <circle class="dot dot3" cx="190" cy="100" />
                    <circle class="dot dot4" cx="260" cy="150" />

                    
                    </svg>
               
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Powerful Features</h2>
            <p class="lead text-muted">Everything you need for efficient attendance management</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-light-primary text-primary mb-4">
                            <i class="bi bi-people-fill fs-2"></i>
                        </div>
                        <h4>Employee Management</h4>
                        <p class="text-muted">Easily manage all employee records and their attendance data in one centralized system.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-light-success text-success mb-4">
                            <i class="bi bi-fingerprint fs-2"></i>
                        </div>
                        <h4>ZKT Device Integration</h4>
                        <p class="text-muted">Direct integration with ZKT biometric devices for accurate and reliable attendance tracking.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-light-info text-info mb-4">
                            <i class="bi bi-file-earmark-bar-graph fs-2"></i>
                        </div>
                        <h4>Comprehensive Reports</h4>
                        <p class="text-muted">Generate detailed attendance reports for individuals or departments with export capabilities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">How It Works</h2>
            <p class="lead text-muted">Simple steps to manage your attendance system</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4>Connect Devices</h4>
                    <p>Connect your ZKT biometric devices to the system through network or USB.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4>Sync Employee Data</h4>
                    <p>Upload or sync employee data between your HR system and the biometric devices.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4>Monitor & Export</h4>
                    <p>View real-time attendance data and export reports in multiple formats.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-dark text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Ready to streamline your attendance management?</h2>
        <p class="lead mb-4">Join hundreds of companies using our ZKT attendance system</p>
        <div class="d-flex flex-column align-items-center gap-2">
            
            <a href="tel:+1234567890" class="btn btn-outline-light btn-lg px-5">
                <i class="bi bi-telephone-fill me-2"></i> +1 234 567 890
            </a>
        </div>
    </div>
</section>

@endsection

@push('custome-js')

@endpush