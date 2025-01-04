<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Styling untuk dark theme */
        body {
            background-color: #121212;
            color: #ffffff;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #ffffff;
        }

        label {
            color: #ffffff;
        }

        .form-control {
            background-color: #1f1f1f;
            color: #ffffff;
            border: 1px solid #343a40;
        }

        .form-control:focus {
            background-color: #343a40;
            color: #ffffff;
            border-color: #888888;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #000000;
            border-color: #000000;
        }

        .btn-primary:hover {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-secondary {
            background-color: #1f1f1f;
            border-color: #1f1f1f;
        }

        .btn-secondary:hover {
            background-color: #343a40;
            border-color: #343a40;
        }

        /* Styling untuk tombol hapus material */
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .material-section {
            background-color: #1f1f1f;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Update Course: {{ $course->title }}</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $course->title) }}"
                    required>
                @error('title')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    required>{{ old('description', $course->description) }}</textarea>
                @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div id="materials-container">
                @foreach($course->materials as $index => $material)
                <div class="material-section">
                    <h4>Material {{ $index + 1 }}</h4>
                    <input type="hidden" name="materials[{{ $index }}][id]" value="{{ $material->id }}">
                    <div class="mb-3">
                        <label for="material_title_{{ $index }}" class="form-label">Material Title</label>
                        <input type="text" class="form-control" id="material_title_{{ $index }}"
                            name="materials[{{ $index }}][title]"
                            value="{{ old('materials.'.$index.'.title', $material->title) }}" required>
                        @error('materials.'.$index.'.title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="material_content_{{ $index }}" class="form-label">Material Content</label>
                        <textarea class="form-control" id="material_content_{{ $index }}"
                            name="materials[{{ $index }}][content]" rows="3"
                            required>{{ old('materials.'.$index.'.content', $material->content) }}</textarea>
                        @error('materials.'.$index.'.content')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="material_image_{{ $index }}" class="form-label">Current Image</label>
                        @if($material->image_path)
                        <img src="{{ asset($material->image_path) }}" alt="Current Image"
                            style="max-width: 200px; max-height: 200px;">
                        @else
                        <p>No image uploaded for this material.</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="material_image_{{ $index }}" class="form-label">Upload New Image (Optional)</label>
                        <input type="file" class="form-control" id="material_image_{{ $index }}"
                            name="materials[{{ $index }}][image]">
                        @error('materials.'.$index.'.image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="button" class="btn btn-danger remove-material"
                        data-material-id="{{ $material->id }}">Remove Material</button>
                </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-secondary mt-3" id="add-material">Add Material</button>
            <button type="submit" class="btn btn-primary mt-3">Update Course</button>
        </form>
    </div>

    <script>
        let materialCount = {{ $course->materials->count() }};

        document.getElementById('add-material').addEventListener('click', function () {
            materialCount++;

            let materialTemplate = `
                <div class="material-section">
                    <h4>Material ${materialCount}</h4>
                    <div class="mb-3">
                        <label for="material_title_${materialCount}" class="form-label">Material Title</label>
                        <input type="text" class="form-control" id="material_title_${materialCount}" name="materials[${materialCount - 1}][title]" required>
                        @error('materials.${materialCount - 1}.title')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="material_content_${materialCount}" class="form-label">Material Content</label>
                        <textarea class="form-control" id="material_content_${materialCount}" name="materials[${materialCount - 1}][content]" rows="3" required></textarea>
                        @error('materials.${materialCount - 1}.content')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="material_image_${materialCount}" class="form-label">Upload New Image (Optional)</label>
                        <input type="file" class="form-control" id="material_image_${materialCount}" name="materials[${materialCount - 1}][image]">
                    </div>

                    <button type="button" class="btn btn-danger remove-material">Remove Material</button>
                </div>
            `;

            let newMaterialDiv = document.createElement('div');
            newMaterialDiv.innerHTML = materialTemplate;
            document.getElementById('materials-container').appendChild(newMaterialDiv);
        });

        // Event listener untuk tombol "Remove Material"
        document.getElementById('materials-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-material')) {
                e.target.closest('.material-section').remove();
            }
        });
    </script>
</body>

</html>