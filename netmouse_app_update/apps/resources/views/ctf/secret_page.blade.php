<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Page Challenge</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: 'Courier New', Courier, monospace;
        }
        .container {
            margin-top: 50px;
            text-align: center;
        }
        .btn {
            background-color: #238636;
            color: #fff;
            border: none;
        }
        .btn:hover {
            background-color: #2ea043;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Secret Page Challenge</h1>
        <p>Decrypt the hidden text to find the flag:</p>
        
        <!-- Hidden encrypted text in HTML source code -->
        <!-- Encrypted Text: {{ $encryptedText }} -->
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('ctf.submit_secret_flag') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="flag" class="form-label">Submit your flag:</label>
                <input type="text" id="flag" name="flag" class="form-control" placeholder="Enter your decrypted text" required>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
</html>
