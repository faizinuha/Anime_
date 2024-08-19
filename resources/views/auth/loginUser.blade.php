<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        



        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Roboto:wght@400;500;700&display=swap");

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: "Roboto", sans-serif;
}
body {
	position: relative;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	background: linear-gradient(to bottom, #5d326c, #350048); /*fiolet*/
}

        body {
            font-family: 'Mulish', Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            perspective: 1000px;
        }
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px;
            transform: rotateY(0deg) rotateX(0deg);
            transition: transform 0.1s ease;
        }
        .login-container h2 {
            margin-bottom: 25px;
            font-size: 26px;
            text-align: center;
            color: #4f46e5;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        .login-container input[type="email"], 
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            box-sizing: border-box;
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .login-container button:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
        }
        .login-container .register-link {
            text-align: center;
            margin-top: 10px;
        }
        .login-container .register-link a {
            color: #4f46e5;
            text-decoration: none;
            font-size: 14px;
        }
        .login-container .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container" id="loginContainer">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <div class="register-link">
                <a href="{{route('register2')}}">Don't have an account? Register</a>
            </div>
        </form>        
    </div>

    <script>
        const container = document.getElementById('loginContainer');

        document.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 25;

            container.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });

        container.addEventListener('mouseenter', (e) => {
            container.style.transition = "none";
        });

        container.addEventListener('mouseleave', (e) => {
            container.style.transition = "transform 0.5s ease";
            container.style.transform = `rotateY(0deg) rotateX(0deg)`;
        });
    </script>
</body>
</html>
