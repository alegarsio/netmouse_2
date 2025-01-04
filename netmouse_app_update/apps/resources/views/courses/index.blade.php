<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Styling for dark theme */
        body {
            background-color: #121212;
            color: #ffffff;
        }

        h1 {
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
            height: 100%;
            min-height: 100vh; /* Memastikan sidebar memanjang sampai bawah */
            position: sticky; /* Membuat sidebar tetap di tempat saat scroll */
            top: 0; /* Memastikan posisinya tetap */
            background-color: #1f1f1f;
            padding: 20px;
            border-right: 1px solid #343a40;
        }

        .sidebar h5 {
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #343a40; /* Warna hover */
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

        .top-section {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            color: #ffffff;
            font-weight: bold;
            font-size: 1rem;
            position: relative;
        }

        .course-card .course-code {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .bottom-section {
            padding: 20px;
        }

        .course-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #ffffff;
        }

        .instructor,
        .enrolled {
            font-size: 0.85rem;
            color: #bbbbbb;
            display: flex;
            align-items: center;
            margin-top: 5px;
        }

        .instructor i,
        .enrolled i {
            margin-right: 5px;
            color: #888888;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Net<span style="color: red;">Mouse</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search courses" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <h5>Navigation</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mentor_index') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.myCourses') }}">My Courses</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.create') }}">Create Course</a>
                    </li>
                    
                    
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <h1 class="text-center mb-4">NetMouse NeCa</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($courses->isEmpty())
                <p class="text-center">No courses available at the moment.</p>
            @else
                <div class="row">
                    @foreach($courses as $index => $course)
                        @php
                            $gradient = $gradients[$index % count($gradients)];
                        @endphp
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="course-card">
                                <div class="top-section" style="background: linear-gradient(135deg, {{ $gradient[0] }}, {{ $gradient[1] }});">
                                    <div class="course-code">2425/1</div> </div>

                                <div class="bottom-section">
                                    <div class="course-title">{{ $course->title }}</div>
                                    <div class="instructor">
                                        <i class="fas fa-user"></i> {{ $course->mentor->name ?? 'Unknown Mentor' }}
                                    </div>

                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary btn-sm w-100 mt-2">Edit</a>

                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');" style="margin-top: 10px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>