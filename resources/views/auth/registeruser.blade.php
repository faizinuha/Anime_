<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Register</title>
    <style>
        body {
            font-family: 'Mulish', Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            perspective: 800px;
        }
        .register-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px;
            transform: rotateY(8deg) translateZ(20px);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .register-container:hover {
            transform: rotateY(0deg) translateZ(0px) scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .register-container h2 {
            margin-bottom: 25px;
            font-size: 26px;
            text-align: center;
            color: #4f46e5;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.15);
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
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .register-container input[type="text"]:focus, 
        .register-container input[type="email"]:focus,
        .register-container input[type="password"]:focus {
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.2);
            border-color: #4f46e5;
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
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .register-container button:hover {
            background-color: #4338ca;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="text" class="form-control" id="name" name="name"
            placeholder="Enter your username" autofocus required>
            <input type="email" class="form-control" id="email" name="email"
            placeholder="Enter your email" required>
            <input type="password" id="password" class="form-control" name="password"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" 
            required aria-describedby="password" />
            <input type="password" id="password_confirmation" class="form-control"
            name="password_confirmation"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" 
            autocomplete="new-password" required />
            {{-- <a href="" class="small" >Media</a> --}}
            <button type="submit" class="btn" >Register</button>
            <div class="login-link">
                <a href="{{route('login2')}}">Already have an account? Login</a>
            </div>
        </form>        
    </div>
    <script>
        document.addEventListener('mousemove', (event) => {
            const containers = document.querySelectorAll('.login-container');
            containers.forEach(container => {
                const rect = container.getBoundingClientRect();
                const x = (event.clientX - rect.left) / rect.width;
                const y = (event.clientY - rect.top) / rect.height;

                const rotateX = (y - 0.5) * 30; // Adjust for more/less rotation
                const rotateY = (x - 0.5) * -30;

                container.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(20px)`;
            });
        });
    </script>
</body>
</html>
