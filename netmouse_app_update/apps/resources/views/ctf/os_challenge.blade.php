<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OS Detection Challenge</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;  
            color: #e0e0e0; 
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 5% auto;
            background-color: #1f1f1f;  /* Dark card background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffffff;  /* White text for headings */
        }
        p {
            font-size: 16px;
            color: #b0b0b0;  /* Light grey text for paragraphs */
        }
        .form-group {
            margin: 20px 0;
        }
        label {
            font-weight: 500;
            color: #e0e0e0;  /* Light color for label */
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #333;  /* Dark border for input */
            background-color: #333;  /* Dark input background */
            color: #e0e0e0;  /* Light text color in input */
            font-size: 16px;
            margin-top: 10px;
            outline: none;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: #4e73df;  /* Blue focus border */
        }
        button {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2e59d9;  /* Darker blue when hovered */
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>OS Detection Challenge</h2>
        <p>Try to find the operating system used by the website vulnweb.com.</p>
        <p><strong>Hint:</strong> Use tools like <code>nmap</code> and enable OS detection.</p>

        <form action="{{ route('ctf.check_os_flag') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="os_flag">Enter the Operating System:</label>
                <input type="text" name="os_flag" id="os_flag" class="form-control" required>
            </div>
            <button type="submit">Submit</button>
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
</body>
</html>
