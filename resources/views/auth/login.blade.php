<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Portal Login</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      display: flex;
      width: 950px;
      height: 560px;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
      background: #ffffff;
    }

    /* Left (Login) Section */
    .login-section {
      width: 45%;
      background-color: #1e1e1e;
      color: #fff;
      padding: 60px 45px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-section h2 {
      font-size: 28px;
      margin-bottom: 8px;
    }

    .login-section p {
      color: #aaa;
      font-size: 14px;
      margin-bottom: 25px;
    }

    form label {
      font-size: 13px;
      color: #ccc;
      margin-bottom: 6px;
      display: block;
    }

    form input {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      margin-bottom: 18px;
      background-color: #2a2a2a;
      color: #fff;
    }

    form input::placeholder {
      color: #777;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background-color: #a37ef9;
      border: none;
      border-radius: 6px;
      color: white;
      font-weight: 500;
      cursor: pointer;
      font-size: 15px;
      transition: 0.3s;
    }

    .login-btn:hover {
      background-color: #8b66e8;
    }

    .alert {
      background-color: #ff4d4d;
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 13px;
    }

    .field-error {
      color: #ff8c8c;
      font-size: 13px;
      margin-top: -14px;
      margin-bottom: 10px;
    }

    /* Right (Image) Section */
    .welcome-section {
      width: 55%;
      background-color: #ffffff;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .welcome-section img {
      width: 90%;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        width: 90%;
        height: auto;
      }

      .login-section, .welcome-section {
        width: 100%;
        height: auto;
      }

      .welcome-section img {
        width: 80%;
        margin: 30px auto;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Left Login -->
    <div class="login-section">
      <h2>Login</h2>
      <p>Enter your account details</p>

      {{-- Error Message --}}
      @if(session('error'))
        <div class="alert">{{ session('error') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert">
          <strong>Please fix the following errors:</strong>
          <ul style="margin:8px 0 0; padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li style="margin-bottom:6px;">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
        @error('email')
          <div class="field-error">{{ $message }}</div>
        @enderror

        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="Enter your password" required>
        @error('password')
          <div class="field-error">{{ $message }}</div>
        @enderror

        <button type="submit" class="login-btn">Login</button>
      </form>
    </div>

    <!-- Right Section (White + Image) -->
    <div class="welcome-section">
      <img src="{{ asset('assets/images/ok.webp') }}" alt="Student Illustration">
    </div>
  </div>
</body>
</html>
