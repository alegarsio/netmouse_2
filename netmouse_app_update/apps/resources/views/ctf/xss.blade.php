<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF - XSS Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #d84315, #ff6f61);
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2>XSS Challenge</h2>
            <p class="text-muted">Coba eksploitasi halaman ini dengan XSS untuk mendapatkan flag!</p>
        </div>

        <!-- Form untuk input XSS -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Masukkan Input Anda</h5>
                <form method="POST" action="{{ route('ctf.handleXss') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="userInput" class="form-label">Input Anda (XSS Rentan)</label>
                        <input type="text" class="form-control" id="userInput" name="userInput" placeholder="Masukkan sesuatu..." required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Input</button>
                </form>
            </div>
        </div>

        <!-- Menampilkan input pengguna tanpa sanitasi -->
        @if (isset($userInput))
            <div class="alert alert-info mt-4">
                <h5>Hasil Input Anda:</h5>
                <p>{{ $userInput }}</p>
            </div>
        @endif

        <!-- Form untuk submit flag -->
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title">Submit Flag</h5>
                <form method="POST" action="{{ route('ctf.submitFlag') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="flag" class="form-label">Masukkan Flag</label>
                        <input type="text" class="form-control" id="flag" name="flag" required>
                    </div>
                    <button type="submit" class="btn btn-success">Kirim Flag</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
