<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF Challenges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            background-color: #121212;
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        .container {
            max-width: 1100px;
        }
        h2 {
            color: #28a745;
            font-weight: bold;
            font-size: 2.5rem;
        }
        .card {
            border: none;
            background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);
            color: #ffffff;
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
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
        .card-body h5 {
            font-weight: bold;
            color: #ffcc00;
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
        .section-title {
            color: #0dcaf0;
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .badge {
            background: linear-gradient(45deg, #fca311, #ff9a3c);
            color: #fff;
            font-size: 0.9em;
            padding: 6px 12px;
            border-radius: 12px;
        }
        .row {
            margin-top: 40px;
        }
        @media (max-width: 768px) {
            h2 {
                font-size: 2rem;
            }
            .card-body {
                padding: 20px;
            }
            .btn-primary {
                padding: 10px 15px;
                font-size: 0.9rem;
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
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('about_ctf') }}">Tentang Kami</a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2>CTF Challenges</h2>
            <p class="text-muted">Jelajahi berbagai tantangan CTF dan tingkatkan keterampilan Anda!</p>
        </div>

        <!-- Daftar Tantangan -->
        <div class="row mt-4">
            @foreach($challenges as $index => $challenge)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm gradient-{{ ($index % 4) + 1 }}">
                        <div class="card-body">
                            <div class="section-title">Tantangan {{ $index + 1 }}</div>
                            <h5 class="card-title">{{ $challenge['title'] }}</h5>
                            <p class="card-text">{{ $challenge['description'] }}</p>
                            <p><strong>Kesulitan:</strong> <span class="badge rounded-pill">{{ $challenge['difficulty'] }}</span></p>
                            
                            <!-- Link ke tantangan enkripsi jika judulnya mengandung kata "Encryption" -->
                            @if(strpos($challenge['title'], 'Encryption') !== false)
                                <a href="{{ route('challenge.show', ['id' => $index + 1, 'type' => 'encryption']) }}" class="btn btn-primary">Coba Tantangan Enkripsi</a>
                            @else
                                <a href="{{ route('challenge.show', ['id' => $index + 1]) }}" class="btn btn-primary">Coba Tantangan</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
