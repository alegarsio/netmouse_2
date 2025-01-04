<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* General Styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        /* Navbar Styling */
        .navbar {
            background-color: #1c1c1e;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid #333;
        }
        .navbar-brand {
            font-weight: 700;
            color: #f4f4f4;
        }
        .navbar-brand:hover {
            color: #007bff;
        }
        .navbar-nav .nav-link {
            color: #f4f4f4;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #1c1c1e;
            min-height: 100vh;
            padding-top: 20px;
            border-right: 1px solid #333;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.2);
        }
        .sidebar h4 {
            color: #f4f4f4;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .sidebar .nav-link {
            color: #cfcfcf;
            padding: 12px 20px;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 25px;
        }

        /* Button Styling */
        .btn-primary, .btn-success, .btn-warning {
            border-radius: 50px;
            padding: 12px 30px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover, .btn-success:hover, .btn-warning:hover {
            transform: scale(1.05);
        }

        /* Category Colors */
        .academy-card { background: linear-gradient(145deg, #6f42c1, #8e44ad); }
        .ctf-card { background: linear-gradient(145deg, #28a745, #218838); }
        .network-card { background: linear-gradient(145deg, #fd7e14, #e67e22); }

        /* Main Heading */
        .text-primary {
            font-size: 2rem;
            color: #fff;
        }
        .text-primary span {
            color: #f44336;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 999;
                width: 80%;
                padding: 15px;
            }
            .sidebar h4 {
                margin-bottom: 15px;
            }
            .sidebar .nav-link {
                padding: 10px 12px;
            }
            .col-md-9 {
                margin-left: 80%;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Net<span style="color: white;">Mouse</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('custom_profile.show') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar">
            <h4>Welcome, {{ Auth::user()->name }}!</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student.courses') }}">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('custom_profile.show') }}">Profile</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-primary">
                        <span style="color: white;">Net</span>
                        <span style="color: red;">Mouse</span>
                    </h2>
                    <p>Welcome back! Explore your courses below:</p>
                </div>
            </div>

            <!-- Course Categories -->
            <div class="row mt-4">
                <!-- Academy Category -->
                <div class="col-md-4 mb-4">
                    <div class="card academy-card text-white shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Academy</h5>
                            <p class="card-text">Jelajahi kemampuan dan skill baru di dalam dunia cyber security dengan mentor profesional kami, dan metode belajar yang interaktif.</p>
                            <a href="{{ route('student.courses') }}" class="btn btn-primary">Go to Academy</a>
                        </div>
                    </div>
                </div>

                <!-- CTF Category -->
                <div class="col-md-4 mb-4">
                    <div class="card ctf-card text-white shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">CTF</h5>
                            <p class="card-text">Tantang dirimu dan asah kemampuan dalam memecahkan masalah cyber security dalam tantangan ctf kami.</p>
                            <a href="{{ route('ctf.index') }}" class="btn btn-success">Go to CTF</a>
                        </div>
                    </div>
                </div>

                <!-- Network Simulation Category -->
                <div class="col-md-4 mb-4">
                    <div class="card network-card text-white shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Network Simulation</h5>
                            <p class="card-text">Buat Sebuah Topologi jaringan dan uji mulai dari sisi keamanan sampai performa topologi yang kamu buat.</p>
                            <a href="{{ route('netsim') }}" class="btn btn-success">Go to NetSim</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

