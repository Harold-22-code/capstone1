
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'San Jacinto Parish') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">

    <!-- Tailwind (via Vite) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero {
            background: url('{{ asset('images/church-bg.jpg') }}') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5rem 1rem;
            width: 100%;
        }
    </style>
</head>
<body class="bg-light font-sans text-gray-800">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">{{ config('app.name', 'San Jacinto Parish') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero min-h-screen d-flex align-items-center text-white">
        <div class="container text-center overlay py-5">
            <h1 class="display-4 fw-bold">Welcome to San Jacinto de Polonia Parish</h1>
            <p class="lead mt-3">A community rooted in faith, love, and service.</p>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">About Our Parish</h2>
            <p class="mb-0">San Jacinto de Polonia Parish is dedicated to serving the faithful through the Sacraments, prayer, and community outreach. We aim to be a spiritual home for all who seek Christ and wish to grow in their Catholic faith.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Mass Schedule</h2>
            <ul class="list-unstyled">
                <li>🕊 Sunday Mass: 7:00 AM | 9:00 AM | 5:00 PM</li>
                <li>🕯 Weekday Mass: 6:00 AM</li>
                <li>🙏 Confession: Saturdays at 4:00 PM</li>
            </ul>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Contact Us</h2>
            <p>📍 Barangay Polonia, San Jacinto, Philippines</p>
            <p>📞 (123) 456-7890</p>
            <p>📧 parish@example.com</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        &copy; {{ date('Y') }} San Jacinto de Polonia Parish. All rights reserved.
    </footer>

</body>
