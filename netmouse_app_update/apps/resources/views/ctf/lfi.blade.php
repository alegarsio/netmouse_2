<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LFI Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

    <div class="container mt-5">
        <h1 class="text-center">LFI Challenge</h1>
        <p>Find the hidden flag by viewing the page source and submit it below.</p>
        
        <div class="alert alert-warning">
            Hint: The flag is hidden as a comment in the HTML source code.
        </div>
        
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Hidden flag -->
        <!-- VGhpcyBpcyB0aGUgZmxhZzogcGFzc3dvcmRrdQ== -->

        <!-- Form for flag submission -->
        <form action="{{ route('ctf.lfi.submit') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="flag" class="form-label">Enter Flag</label>
                <input type="text" name="flag" id="flag" class="form-control" placeholder="Submit your flag" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Flag</button>
        </form>
    </div>

</body>
</html>
