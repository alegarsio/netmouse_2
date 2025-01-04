<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses for Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Styling for dark theme */
        body {
            background-color: #121212;
            color: #ffffff;
        }

        /* Navbar styling */
        .navbar {
            background-color: #1f1f1f;
        }

        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }

        /* Sidebar styling */
        .sidebar {
            background-color: #1f1f1f;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
            padding-left: 15px;
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #ff758c;
        }

        /* Sidebar toggle button */
        .sidebar-toggle-btn {
            background-color: #1f1f1f;
            border: none;
            color: #ffffff;
            font-size: 1.5rem;
            position: absolute;
            top: 20px;
            left: 10px;
            z-index: 1000;
            transition: transform 0.3s;
        }

        /* Main content */
        .content {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .content.collapsed {
            margin-left: 0;
        }

        /* Styling for the course cards */
        .course-card {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            background-color: #1f1f1f;
            color: #ffffff;
            transition: transform 0.3s;
        }

        .course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.6);
        }

        /* Gradient top section */
        .top-section {
            height: 100px;
            background: linear-gradient(135deg, #ff758c, #ff7eb3); /* Example gradient */
        }

        /* Bottom section for the course title and mentor name */
        .bottom-section {
            padding: 15px;
            text-align: center;
        }

        .course-title {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .mentor-name {
            font-size: 0.9rem;
            color: #b3b3b3;
            margin-top: 5px;
        }

        .join-btn {
            margin-top: 10px;
            background-color: #9819c1;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .join-btn:hover {
            background-color: #ff758c;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Net<span style="color : red;">Mouse</span> Academy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Optional links here -->
            </ul>
            <!-- Search bar -->
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search courses" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<!-- Sidebar toggle button -->
<button class="sidebar-toggle-btn" id="sidebarToggleBtn">&#9776;</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <h4>Menu</h4>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('courses.joined.list') }}">My Courses</a>
    
    <a href="#">Logout</a>
</div>

<!-- Main content area -->
<div class="content" id="mainContent">
    

    <div class="row">
        @foreach($courses as $index => $course)
            @php
                // Optional gradient colors for variety if needed
                $gradients = [
                    ['#4e54c8', '#8f94fb'],
                    ['#ff758c', '#ff7eb3'],
                    ['#43c6ac', '#f8ffae'],
                ];
                $gradient = $gradients[$index % count($gradients)];
            @endphp
            <div class="col-md-4 d-flex justify-content-center">
                <div class="course-card">
                    <div class="top-section" style="background: linear-gradient(135deg, {{ $gradient[0] }}, {{ $gradient[1] }});">
                    </div>
                    <div class="bottom-section">
                        <div class="course-title">{{ $course->title }}</div>
                        <div class="mentor-name">by {{ $course->mentor->name }}</div>
                        <!-- Add the 'Join' button -->
                        <form action="{{ route('courses.join', $course->id) }}" method="POST">
                         @csrf
                           <button type="submit" class="join-btn">Join</button>
                         </form>

                        </form>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle Sidebar visibility
    const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    sidebarToggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
    });
</script>

</body>
</html> 
