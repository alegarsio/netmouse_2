<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF Challenges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .challenge-card {
            background: linear-gradient(135deg, #1e1e1e 0%, #2d2d2d 100%);
            color: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .challenge-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }

        .challenge-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .challenge-desc {
            margin: 10px 0;
            font-size: 1rem;
            line-height: 1.5;
        }

        .btn-challenge {
            background-color: #ff9f00;
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 0.9rem;
        }

        .btn-challenge:hover {
            background-color: #ffae33;
            color: black;
        }

        .completed-badge {
            background-color: #28a745;
            color: #fff;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">CTF Challenges</h1>

        @foreach ($challenges as $challenge)
        <div class="challenge-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="challenge-title">{{ $challenge['title'] }}</h3>
                    <p class="challenge-desc">{{ $challenge['description'] }}</p>
                </div>
                @if (in_array($challenge['key'], $completedChallenges))
                <span class="completed-badge">&#x2714; Completed</span>
                @endif
            </div>
            <a href="{{ $challenge['url'] }}" class="btn btn-challenge mt-3">Go to Challenge</a>
        </div>
        @endforeach

    </div>

</body>

</html>
