<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #333;
            line-height: 1.6;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .breadcrumb {
            background-color: #4f46e5;
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .breadcrumb h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .profile-section {
            padding: 60px 0;
        }
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }
        @media (min-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        .profile-card {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .profile-card h3 {
            color: #4f46e5;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .profile-photo {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
        }
        .profile-info {
            margin-bottom: 15px;
        }
        .profile-info strong {
            display: inline-block;
            width: 100px;
        }
        .edit-button {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .edit-button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <section class="breadcrumb">
        <div class="container">
            <h2>Profile</h2>
            <p>Welcome to your profile page.</p>
        </div>
    </section>

    <section class="profile-section">
        <div class="container">
            <div class="profile-grid">
                <div class="profile-card">
                    <h3>Profile Information</h3>
                    <!-- Display profile photo if exists -->
                    <img src="{{ asset($user->photo ?? 'default-photo.jpg') }}" alt="Profile Photo" class="profile-photo">
                    <div class="profile-info">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                    </div>
                    <div class="profile-info">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                    <!-- You can add more user information here -->
                    <div class="profile-info">
                        <p><strong>Favorite Place:</strong> Tokyo, Japan</p> <!-- Example data -->
                    </div>
                </div>
                <div class="profile-card">
                    <h3>Update Profile</h3>
                    <!-- Edit button can be linked to an edit page -->
                    <button class="edit-button" onclick="window.location.href='{{ route('user.edit', $user->id) }}'">Edit Profile</button>
                    <!-- Example link back to anime list -->
                    <a href="{{ route('Anim') }}">
                        <button class="edit-button">Back to Anime List</button>
                    </a>
                </div>          
            </div>
        </div>
</body>
</html>
