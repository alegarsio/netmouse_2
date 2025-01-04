<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Menambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Menambahkan CSS Kustom -->
    <style>
        /* Gaya untuk keseluruhan halaman */
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 50px;
        }

        /* Card Profil */
        .card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card-header {
            border-radius: 20px 20px 0 0;
            background-color: #007bff;
            color: #fff;
        }

        .card-header h3 {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .card-body {
            font-size: 1.1em;
            padding: 30px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-item {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .profile-item strong {
            color: #333;
        }

        .profile-item .text-muted {
            color: #555;
        }

        /* Gaya untuk gambar profil */
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Tombol Kembali */
        .card-footer .btn {
            padding: 12px 30px;
            font-size: 1.1em;
            border-radius: 50px;
            background-color: #007bff;
            color: #fff;
            border: none;
            transition: all 0.3s;
        }

        .card-footer .btn:hover {
            background-color: #0056b3;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profil Card -->
                <div class="card shadow-lg">
                    <!-- Header Card -->
                    <div class="card-header text-center">
                        <h3>Your Profile</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <!-- Gambar Profil -->
                        <img src="https://via.placeholder.com/120" alt="Profile Picture" class="profile-avatar">
                        <div class="profile-info">
                            <div class="profile-item">
                                <strong>Name:</strong> <span class="text-muted">{{ $user->name }}</span>
                            </div>
                            <div class="profile-item">
                                <strong>Email:</strong> <span class="text-muted">{{ $user->email }}</span>
                            </div>
                            <div class="profile-item">
                                <strong>Role:</strong> <span class="text-muted">{{ $user->role }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer text-center">
                        <a href="{{ route('index') }}" class="btn">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menambahkan Bootstrap JS dan dependensinya -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
