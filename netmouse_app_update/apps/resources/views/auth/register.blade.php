<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
            background: linear-gradient(145deg, #080808, #000000 , #3b0101);
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

        #registerForm {
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
        }

        button:hover {
            background-color: #b30000;
            transition-duration: 1s;
        }

        .login-link {
            margin-top: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: black;
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column; 
            }
            #registerForm {
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
            <form id="registerForm" method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Register</h1>

                <!-- Name -->
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit">Register</button>

                <a href="{{ route('login') }}" class="login-link">
                    Sudah punya akun? <span style="color: red;">Masuk</span>
                </a>
            </form>
        </div>
    </div>

</body>
</html>
