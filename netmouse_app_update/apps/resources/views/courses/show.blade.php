<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            /* Light background */
            color: #343a40;
            /* Dark text */
            font-family: 'Inter', sans-serif;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #007bff 0%, #00d4ff 100%);
            /* Blue gradient */
            color: white;
            padding: 80px 20px;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 40px;
        }

        .hero-section:before {
            content: '';
            position: absolute;
            top: -80px;
            left: -80px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.2);
            filter: blur(60px);
            border-radius: 50%;
            opacity: 0.5;
        }

        .hero-section:after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.15);
            filter: blur(70px);
            border-radius: 50%;
            opacity: 0.5;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            /* Larger title */
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.4rem;
            color: #fff;
            font-weight: 500;
        }

        /* Card Styles */
        .course-detail-card,
        .sidebar {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            padding: 25px;
            margin-bottom: 30px;
            border: none;
            /* Remove border */
        }

        .course-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            color: #212529;
            /* Dark text for title */
        }

        .course-header p {
            color: #555;
            /* Slightly darker text */
            margin-bottom: 5px;
            /* Space between lines */
        }

        /* List Group Styling */
        .list-group-item {
            background-color: #fff;
            border: 1px solid #ddd;
            /* Light border */
            border-radius: 8px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            color: #343a40;
        }

        .list-group-item:hover {
            background-color: #007bff;
            /* Blue on hover */
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-color: #007bff;
        }

        .list-group-item h5 {
            font-weight: 600;
        }

        .list-group-item p {
            color: #555;
        }

        .sidebar h4 {
            font-size: 1.7rem;
            color: #212529;
            margin-bottom: 20px;
        }

        .sidebar p {
            font-size: 1.1rem;
            color: #495057;
            /* Dark gray */
        }

        .sidebar strong {
            font-weight: 600;
        }

        /* Buttons */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .course-materials h3 {
            margin-top: 30px;
            font-weight: 700;
        }

        /* Image Styling */
        .material-image {
            max-width: 100%;
            /* Make image responsive */
            height: auto;
            display: block;
            /* Prevents image from overflowing its container */
            margin-top: 20px;
            border-radius: 8px;
            /* Optional: Add a border radius to the image */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Optional: Add a subtle shadow */
        }
    </style>

</head>

<body>

    <div class="container mt-5">
        <div class="hero-section">
            <h1>{{ $course->title }}</h1>
            <p>By: <strong>{{ $course->mentor->name }}</strong></p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="course-detail-card">
                    <div class="course-header">
                        <h1>{{ $course->title }}</h1>
                        <p><strong>Mentor:</strong> {{ $course->mentor->name }}</p>
                        <p><strong>Description:</strong> {{ $course->description }}</p>
                    </div>

                    <div class="course-materials">
                        <h3>Course Materials</h3>
                        @if($course->materials->isEmpty())
                        <p>No materials available for this course.</p>
                        @else
                        <ul class="list-group">
                            @foreach($course->materials as $material)
                            <li class="list-group-item">
                                <h5>{{ $material->title }}</h5>
                                <p>{{ $material->content }}</p>
                                {{-- Tampilkan Gambar --}}
                                @if ($material->image_url)
                                    <img src="{{ $material->image_url }}" alt="Gambar Materi: {{ $material->title }}" class="material-image">
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>