<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus yang Anda Ikuti</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        h1, .card-title {
            color: #ffffff;
        }
        .card {
            background-color: #1f1f1f;
            border: none;
        }
        .btn-primary {
            background-color: #343a40;
            border-color: #343a40;
        }
        .btn-primary:hover {
            background-color: #495057;
            border-color: #495057;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Kursus yang Anda Ikuti</h1>

        <!-- Periksa apakah ada kursus yang diikuti -->
        <?php if ($joinedCourses->isEmpty()): ?>
            <p>Anda belum mengikuti kursus apa pun.</p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($joinedCourses as $joined): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($joined->course->title) ?></h5>
                                <p class="card-text">
                                    <?= htmlspecialchars(\Illuminate\Support\Str::limit($joined->course->description, 100)) ?>
                                </p>
                                <a href="<?= route('courses.show', $joined->course->id) ?>" class="btn btn-primary">
                                    Lihat Kursus
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

