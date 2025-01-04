<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF Encryption Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0a0f14;
            color: #c9d1d9;
            font-family: 'Courier New', Courier, monospace;
        }

        .challenge-container {
            background: linear-gradient(145deg, #11161d, #0d1117);
            color: #c9d1d9;
            border: 1px solid #2d3748;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        h1, h2, h3 {
            font-weight: bold;
            text-shadow: 0 0 10px #2ea043, 0 0 20px #2ea043;
        }

        h2 {
            color: #2ea043;
        }

        .btn-primary {
            background: linear-gradient(145deg, #2ea043, #238636);
            color: #ffffff;
            font-weight: bold;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(46, 164, 67, 0.5);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(145deg, #3fcf59, #2ea043);
            box-shadow: 0 8px 20px rgba(63, 207, 89, 0.7);
        }

        .form-control {
            background-color: #0d1117;
            color: #c9d1d9;
            border: 1px solid #2d3748;
            border-radius: 8px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .form-control:focus {
            background-color: #0d1117;
            color: #c9d1d9;
            border-color: #2ea043;
            box-shadow: 0 0 10px #2ea043;
        }

        .alert {
            background-color: #11161d;
            border: 1px solid #2ea043;
            color: #2ea043;
        }

        .alert-danger {
            border-color: #d73a49;
            color: #d73a49;
        }

        footer {
            margin-top: 30px;
            font-size: 14px;
            color: #57606a;
        }

        footer a {
            color: #2ea043;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="challenge-container">
            <h1>🔐 CTF Encryption Challenge 🔐</h1>
            <p class="mt-3">We have encrypted a secret message using a Caesar cipher. Your task is to decrypt it and find the flag!</p>

            <h3 class="mt-4">Encrypted Text:</h3>
            <h2 class="mt-2">{{ $encryptedText }}</h2>

            @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('ctf.encryption.check') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="flag" class="form-label">Enter the flag:</label>
                    <input type="text" name="flag" id="flag" class="form-control" placeholder="Your answer here" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

    
    </div>
</body>

</html>
