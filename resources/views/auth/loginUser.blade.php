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
        <svg id="sw-js-blob-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1">                    <defs>                         <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">                            <stop id="stop1" stop-color="rgba(248, 117, 55, 1)" offset="0%"></stop>                            <stop id="stop2" stop-color="rgba(251, 168, 31, 1)" offset="100%"></stop>                        </linearGradient>                    </defs>                <path fill="url(#sw-gradient)" d="M14.6,-24.8C16.8,-24,14.9,-15.8,17.8,-10.4C20.6,-5,28.1,-2.5,31.1,1.7C34.2,6,32.7,12,27.7,13.7C22.8,15.4,14.4,12.9,9.2,17.2C4,21.5,2,32.7,-1.6,35.4C-5.1,38.2,-10.2,32.4,-14.7,27.6C-19.1,22.9,-22.8,19.1,-25.5,14.6C-28.3,10.2,-30,5.1,-26.8,1.8C-23.6,-1.4,-15.5,-2.8,-14.4,-10.1C-13.3,-17.3,-19.1,-30.3,-17.9,-31.7C-16.7,-33.1,-8.3,-22.9,-1.1,-21C6.2,-19.2,12.4,-25.7,14.6,-24.8Z" width="100%" height="100%" transform="translate(50 50)" stroke-width="0" style="transition: 0.3s;" stroke="url(#sw-gradient)"></path>              </svg>
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
