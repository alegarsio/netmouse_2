<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Capture The Flag (CTF)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            background-color: #121212;
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        .navbar {
            margin-bottom: 50px;
        }

        .section-title {
            color: #0dcaf0;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);
            color: #ffffff;
            transition: transform 0.3s, box-shadow 0.3s ease;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, #6a82fb 0%, #fc5c7d 100%);
        }

        .card-body {
            padding: 30px;
            background: rgba(0, 0, 0, 0.6);
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff6f61, #d84315);
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 10px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #d84315, #ff6f61);
            transform: scale(1.05);
        }

        .section-content {
            background-color: #1a1a1a;
            padding: 50px 0;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .team-member {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .member-card {
            background: linear-gradient(135deg, #ff6f61 0%, #d84315 100%);
            color: white;
            border-radius: 10px;
            margin-top: 20px;
        }

        .member-card img {
            width: 100%;
            border-radius: 10px 10px 0 0;
        }

        .member-card-body {
            padding: 20px;
            text-align: center;
        }

        .member-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .member-role {
            font-size: 1.1rem;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Capture The Flag (CTF)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <section class="section-content">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">About Capture The Flag (CTF)</h2>
                <p class="text-muted">Jelajahi dunia keamanan siber melalui tantangan yang menantang dan mengasah keterampilan Anda!</p>
            </div>

            <!-- Introduction -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Apa Itu CTF?</h5>
                            <p class="about-text">
                                Capture The Flag (CTF) adalah kompetisi yang menguji kemampuan dalam keamanan siber. Dalam kompetisi ini, peserta harus memecahkan berbagai tantangan yang berhubungan dengan topik seperti kriptografi, pemrograman, eksploitasi kerentanannya, dan banyak lagi. CTF adalah cara yang menyenangkan dan edukatif untuk belajar dan mengembangkan keterampilan keamanan siber.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tujuan Kami</h5>
                            <p class="about-text">
                                Kami bertujuan untuk menyediakan platform yang memungkinkan individu untuk belajar, berlatih, dan berkembang dalam dunia keamanan siber. Dengan menyediakan tantangan CTF yang beragam dan menyenangkan, kami berharap dapat membantu peserta meningkatkan keterampilan mereka di dunia nyata.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            
            
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
