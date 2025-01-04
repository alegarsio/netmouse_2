<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Mentorship</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: #f4f4f4;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .certificate {
            background: linear-gradient(145deg, #4e5d6c, #343a40);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.8), inset 0 0 15px rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #f4f4f4;
            position: relative;
            border: 3px solid rgba(255, 215, 0, 0.8);
            transition: all 0.3s ease-in-out;
        }

        .certificate:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.9), 0 0 20px rgba(255, 215, 0, 0.7);
            transform: scale(1.02);
        }

        .certificate .name {
            font-size: 40px;
            font-weight: bold;
            color: #ffd700;
            margin: 20px 0;
            text-shadow: 1px 1px 5px rgba(255, 255, 255, 0.4);
        }

        .certificate h1 {
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .certificate h2 {
            font-size: 1.8rem;
            color: #f4f4f4;
            margin-bottom: 15px;
        }

        .certificate .message {
            font-style: italic;
            color: #d1d1d1;
            margin: 15px 0;
            line-height: 1.5;
        }

        .certificate .date {
            font-size: 18px;
            color: #aaa;
            margin-top: 30px;
        }

        .certificate .decorative-line {
            width: 150px;
            height: 5px;
            background: linear-gradient(90deg, #ffd700, #f4f4f4, #ffd700);
            margin: 20px auto;
            border-radius: 2px;
        }

        .netmouse-logo {
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 36px;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
        }

        .netmouse-logo span {
            color: #ff4d4d;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Certificate Container -->
        <div class="row justify-content-center">
            <div class="col-md-8 position-relative">
                <!-- Netmouse logo -->
                <div class="netmouse-logo">
                    Net<span>Mouse</span>
                </div>

                <div class="certificate">
                    <h1>Certificate of Mentorship</h1>
                    <div class="decorative-line"></div>
                    <h2>Presented to</h2>
                    <p class="name">{{ $mentorName }}</p>
                    <p class="message">
                        In recognition of your dedication, leadership, and guidance <br> 
                        that have inspired others to excel and achieve their goals.
                    </p>
                    <p class="date">{{ date('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
