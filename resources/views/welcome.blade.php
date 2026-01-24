<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/sms.png') }}">
    <title>CRAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: url("{{ asset('img/crad_final_design.png') }}");
            background-size: cover;
            background-position: center;
        }
        .landing-container {
            text-align: center;
            color: white;
            padding-top: 2vh;
        }
        .landing-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #1a365d;
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.3);
        }
        .landing-subtitle {
            font-size: 1.2rem;
            margin-bottom: 15rem;
            color: #2c5282;
        }
        .login-buttons {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20rem;
        }
        .login-btn {
            padding: 1rem 3rem;
            font-size: 1.1rem;
            border-radius: 10px;
            border: 5px solid white;
            background: linear-gradient(to right, #004C99, #40b6ed);
            color:  #cad6db;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .login-btn:hover {
            background: #40b6ed;
            color: linear-gradient(to right, #004C99, #40b6ed);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <h1 class="landing-title"> Welcome to CRAD</h1>
        
        
        <div class="login-buttons">
            <a href="{{ route('login') }}" class="login-btn">Admin Login</a>
            <a href="{{ route('login') }}" class="login-btn">Student Login</a>
        </div>
    </div>
</body>
</html>
