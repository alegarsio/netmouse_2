<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .left-side {
            flex: 1;
            background: linear-gradient(145deg, #080808, #000000, #3b0101);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
        }

        .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #loginForm {
            width: 100%;
            max-width: 400px;
            height: auto;
            background-color: #fff;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fade_in 2s;
        }

        h1 {
            font-size: 2em;
            color: #3b0101;
            text-align: center;
            animation: myAnim 2s ease 0s 1 normal forwards;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            text-align: center;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b30000;
        }

        .register-link {
            margin-top: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: black;
        }

        /* Google Button Styles */
        .btn-google {
            background-color: #fff;
            color: #000;
            border: 1px solid #ccc;
            border-radius: 20px;
            /* Matching the login button */
            cursor: pointer;
            padding: 10px;
            width: 100%;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Center the content inside the button */
            transition: box-shadow 0.3s ease;
            /* Smooth transition for hover effect */
        }

        .btn-google:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            /* Add a shadow on hover */
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            #loginForm {
                width: 90%;
                margin: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <h2>Net<span style="color: red;">Mouse</span></h2>
        </div>

        <div class="right-side">
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Login</h1>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div style="margin: 10px 0;">
                    <label for="remember_me">
                        <input type="checkbox" id="remember_me" name="remember">
                        Remember Me
                    </label>
                </div>

                <button type="submit">Login</button>

                <a href="{{ url('auth/redirect') }}" class="btn-google" style="
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 10px 10px;
                    border-radius: 8px; /* Rounded corners */
                    border: 1px solid #DADCE0; /* Subtle border */
                    background-color: #fff;
                    color: #3c4043;
                    font-family: 'Roboto', sans-serif;
                    font-size: 14px;
                    text-decoration: none;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.15); /* Subtle shadow */
                    transition: all 0.3s ease;
                    width: 100%;">
                    <img src="{{ asset('images/google.png') }}" alt="Google logo" style="width: 20px; height: 20px; margin-right: 15px;">
                    <span>Login with Google</span>
                </a>

                <style>
                    .btn-google:hover {
                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                        /* More pronounced shadow on hover */
                        background-color: #f8f9fa;
                        border-color: #9aa0a6;
                        cursor: pointer;
                    }
                </style>

                <a href="{{ route('register') }}" class="register-link">
                    Belum punya akun? <span style="color: red;">Daftar</span>
                </a>
            </form>
        </div>
    </div>
</body>
</html>