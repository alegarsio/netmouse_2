<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Base Styles */
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Roboto', sans-serif;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #1f1f1f;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .navbar-brand, .nav-link {
            color: #e0e0e0 !important;
        }

        .nav-link:hover {
            color: #bb86fc !important;
        }

        .navbar-toggler-icon {
            background-color: #e0e0e0 !important;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #fff;
            background: linear-gradient(135deg, #6a11cb, #2575fc); /* Modern gradient */
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        }

        /* Specific Gradient Backgrounds for Each Card */
        .card:nth-child(1) {
            background: linear-gradient(135deg, #ff7e5f, #feb47b); /* Warm sunset gradient */
        }

        .card:nth-child(2) {
            background: linear-gradient(135deg, #6a11cb, #2575fc); /* Purple to blue gradient */
        }

        .card:nth-child(3) {
            background: linear-gradient(135deg, #00c6ff, #0072ff); /* Light blue to royal blue */
        }

        .card .card-title {
            font-weight: bold;
        }

        .btn-primary, .btn-secondary {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            color: #121212;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 1);
            transform: scale(1.05);
        }

        /* Icon Styling */
        .card-body i {
            transition: transform 0.3s ease;
        }

        .card:hover i {
            transform: scale(1.2);
        }

        .header-section {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 60px;
        }

        .header-section h1 {
            font-size: 3rem;
            background: linear-gradient(to right, #bb86fc, #985EFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .header-section p {
            color: #a0a0a0;
            font-size: 1.2rem;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2rem;
            }

            .header-section p {
                font-size: 1rem;
            }

            .card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">NetMouse Mentor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="color: #e0e0e0;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="header-section">
            <h1>Welcome, Mentor!</h1>
            <p>Manage your courses and interact with students from here.</p>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="card text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-book fa-3x mb-3"></i>
                        <h5 class="card-title">Manage Courses</h5>
                        <p class="card-text">Create and update your courses for students.</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary">Go to Courses</a>
                        <a href="{{ route('courses.create') }}" class="btn btn-secondary mt-2">Add Course</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-certificate fa-3x mb-3"></i>
                        <h5 class="card-title">View Certificate</h5>
                        <p class="card-text">View your mentor certificate.</p>
                        <a href="{{ route('mentor.certificate', ['mentorName' => auth()->user()->name]) }}" class="btn btn-primary">Show Certificate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

