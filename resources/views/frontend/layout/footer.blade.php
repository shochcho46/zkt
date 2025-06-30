        <!-- Footer -->
        <footer class="py-4 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; {{ date('Y') }} ZKT Attendance System. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="text-decoration-none me-3">Privacy Policy</a>
                        <a href="#" class="text-decoration-none me-3">Terms of Service</a>
                        <a href="#" class="text-decoration-none">Contact Us</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Smooth scroll for anchor links -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>