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
            background: url('{{ asset('images/church1-bg.jpg') }}') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .glass-overlay {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(6px);
            border-radius: 1rem;
            padding: 4rem 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            font-family: 'Georgia', serif;
        }
    </style>
</head>
<body class="bg-light text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-to-r from-red-900 to-yellow-600 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#">San Jacinto Parish</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-white">
        <div class="container text-center glass-overlay text-red-900">
            <h1 class="display-4 fw-bold drop-shadow-lg">Welcome to San Jacinto de Polonia Parish</h1>
            <p class="lead mt-3 fw-bold">
                A community rooted in 
                <span class="text-yellow-600">faith</span>, 
                <span class="text-yellow-600">love</span>, and 
                <span class="text-yellow-600">service</span>.
            </p>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-warning text-red-900 fw-bold shadow-lg px-4 py-2">Log In</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold text-red-900 mb-4 text-2xl">About Our Parish</h2>
            <p class="max-w-3xl mx-auto">San Jacinto de Polonia Parish is devoted to nurturing the spiritual growth of the faithful through sacraments, prayer, and outreach. Our parish welcomes all who seek Christ and a community of love and faith.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-gradient-to-b from-yellow-50 to-white">
        <div class="container text-center">
            <h2 class="fw-bold text-red-900 mb-4 text-2xl">Mass Schedule</h2>
            <ul class="list-unstyled lead">
                <li class="mb-2">🕊 <strong>Sunday Mass:</strong> 7:00 AM | 9:00 AM | 5:00 PM</li>
                <li class="mb-2">🕯 <strong>Weekday Mass:</strong> 6:00 AM</li>
                <li class="mb-2">🙏 <strong>Confession:</strong> Saturdays at 4:00 PM</li>
            </ul>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold text-red-900 mb-4 text-2xl">Contact Us</h2>
            <p>📍 Barangay Polonia, San Jacinto, Philippines</p>
            <p>📞 (123) 456-7890</p>
            <p>📧 parish@example.com</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 shadow-inner">
        &copy; {{ date('Y') }} San Jacinto de Polonia Parish. All rights reserved.
    </footer>

</body>
</html>
