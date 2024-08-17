<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Register</title>
    <style>
        body {
            font-family: 'Mulish', Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px;
        }
        .register-container h2 {
            margin-bottom: 25px;
            font-size: 26px;
            text-align: center;
            color: #4f46e5;
        }
        .register-container input[type="text"], 
        .register-container input[type="email"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            box-sizing: border-box;
        }
        .register-container button {
            width: 100%;
            padding: 12px;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }
        .register-container button:hover {
            background-color: #4338ca;
        }
        .register-container .login-link {
            text-align: center;
            margin-top: 10px;
        }
        .register-container .login-link a {
            color: #4f46e5;
            text-decoration: none;
            font-size: 14px;
        }
        .register-container .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
            <div class="login-link">
                <a href="{{route('login2')}}">Already have an account? Login</a>
            </div>
        </form>        
    </div>
</body>
</html>
