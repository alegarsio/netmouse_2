<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kursus Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Buat Kursus Baru</h2>
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Judul Kursus</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Kursus</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>

            <hr>

            <div id="materials-container"></div>

            <button type="button" class="btn btn-secondary mb-3" id="add-material-btn">Tambah Materi</button>
            <button type="submit" class="btn btn-primary">Simpan Kursus</button>
        </form>
    </div>

    <script>
        let materialCount = 0;

        document.getElementById('add-material-btn').addEventListener('click', () => {
            const container = document.getElementById('materials-container');
            materialCount++;

            const materialDiv = document.createElement('div');
            materialDiv.className = 'mb-3';
            materialDiv.innerHTML = `
                <h4>Materi ${materialCount}</h4>
                <div class="mb-3">
                    <label for="material_title_${materialCount}" class="form-label">Judul Materi</label>
                    <input type="text" class="form-control" id="material_title_${materialCount}" name="materials[${materialCount - 1}][title]" required>
                </div>
                <div class="mb-3">
                    <label for="material_content_${materialCount}" class="form-label">Konten Materi</label>
                    <textarea class="form-control" id="material_content_${materialCount}" name="materials[${materialCount - 1}][content]" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="material_image_${materialCount}" class="form-label">Gambar (Opsional)</label>
                    <input type="file" class="form-control" id="material_image_${materialCount}" name="materials[${materialCount - 1}][image]">
                </div>
                <hr>
            `;
            container.appendChild(materialDiv);
        });
    </script>
</body>

</html>