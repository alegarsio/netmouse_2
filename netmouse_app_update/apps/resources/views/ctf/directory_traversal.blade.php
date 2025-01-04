<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Traversal Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Directory Traversal Challenge</h2>
        <p>Try to access the flag file by providing the correct path to the file.</p>

        <form action="{{ route('ctf.check_directory_traversal') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="file_path">Enter File Path:</label>
                <input type="text" name="file_path" id="file_path" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
