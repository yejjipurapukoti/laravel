<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        section {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        section .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }

        section .trees {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 100;
            pointer-events: none;
        }

        section .girl {
            position: absolute;
            scale: 0.65;
            pointer-events: none;
            animation: animateGirl 10s linear infinite;
        }

        @keyframes animateGirl {
            0% { transform: translateX(calc(100% + 100vw)); }
            50% { transform: translateX(calc(-100% - 100vw)); }
            50.01% { transform: translateX(calc(-100% - 100vw)) rotateY(180deg); }
            100% { transform: translateX(calc(100% + 100vw)) rotateY(180deg); }
        }

        .login {
            position: relative;
            padding: 60px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            border: 1px solid #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            border-right: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            width: 400px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .login h2 {
            text-align: center;
            font-size: 2em;
            font-weight: 600;
            color: #8f2c24;
        }

        .login .inputBox {
            position: relative;
            width: 100%;
        }

        .login .inputBox input {
            width: 100%;
            padding: 15px 20px;
            outline: none;
            font-size: 1.1em;
            color: #8f2c24;
            border-radius: 5px;
            background: #fff;
            border: none;
            margin-bottom: 20px;
        }

        .login .inputBox ::placeholder {
            color: #8f2c24;
        }

        .login .inputBox #btn {
            border: none;
            outline: none;
            background: #8f2c24;
            color: #fff;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 500;
            transition: 0.5s;
        }

        .login .inputBox #btn:hover {
            background: #d64c42;
        }

        .login .group {
            display: flex;
            justify-content: space-between;
        }

        .login .group a {
            font-size: 1em;
            color: #8f2c24;
            font-weight: 500;
            text-decoration: none;
        }

        .login .group a:nth-child(2) {
            text-decoration: underline;
        }

        .leaves {
            position: absolute;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            pointer-events: none;
        }

        .leaves .set {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .leaves .set div {
            position: absolute;
            display: block;
        }

        .leaves .set div:nth-child(1) { left: 20%; animation: animate 20s linear infinite; }
        .leaves .set div:nth-child(2) { left: 50%; animation: animate 14s linear infinite; }
        .leaves .set div:nth-child(3) { left: 70%; animation: animate 12s linear infinite; }
        .leaves .set div:nth-child(4) { left: 5%; animation: animate 15s linear infinite; }
        .leaves .set div:nth-child(5) { left: 85%; animation: animate 18s linear infinite; }
        .leaves .set div:nth-child(6) { left: 90%; animation: animate 12s linear infinite; }
        .leaves .set div:nth-child(7) { left: 15%; animation: animate 14s linear infinite; }
        .leaves .set div:nth-child(8) { left: 60%; animation: animate 15s linear infinite; }

        @keyframes animate {
            0% { opacity: 0; top: -10%; transform: translateX(20px) rotate(0deg); }
            10% { opacity: 1; }
            20% { transform: translateX(-20px) rotate(45deg); }
            40% { transform: translateX(-20px) rotate(90deg); }
            60% { transform: translateX(20px) rotate(180deg); }
            80% { transform: translateX(-20px) rotate(45deg); }
            100% { top: 110%; transform: translateX(20px) rotate(225deg); }
        }
    </style>
</head>
<body>
<section>
    <div class="leaves">
        <div class="set">
            <div><img src="{{ asset('assets/images/leaf_01.png') }}"></div>
            <div><img src="{{ asset('assets/images/leaf_02.png') }}"></div>
            <div><img src="{{ asset('assets/images/leaf_03.png') }}"></div>
            <div><img src="{{ asset('assets/images/leaf_04.png') }}"></div>
            <div><img src="{{ asset('assets/images/leaf_01.png') }}"></div>
            <div><img src="{{ asset('assets/images/leaf_02.png') }}"></div>
            <div><img src="{{ asset('assets/images/leaf_03.png') }}"></div>
            <div><img src="{{ asset('assets/images/leaf_04.png') }}"></div>
        </div>
    </div>

    <img src="{{ asset('assets/images/bg.jpg') }}" class="bg">
    <img src="{{ asset('assets/images/girl.png') }}" class="girl">
    <img src="{{ asset('assets/images/trees.png') }}" class="trees">

    <div class="login">
    <h2>Sign In</h2>

    {{-- Show session-based error (e.g., invalid credentials) --}}
    @if (session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="error-message">
            <ul style="margin:0; padding-left:15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="inputBox">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        </div>

        <div class="inputBox">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="inputBox">
            <input type="submit" id="btn" value="Login">
        </div>
    </form>

    <div class="group">
        <a href="#">Forgot Password?</a>
        <a href="#">Signup</a>
    </div>
</div>

</section>

<!-- Vendor JS -->
<script src="{{ asset('js/vendors.min.js') }}"></script>
<script src="{{ asset('js/pages/chat-popup.js') }}"></script>
<script src="{{ asset('icons/feather-icons/feather.min.js') }}"></script>

</body>
</html>
