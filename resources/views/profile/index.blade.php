<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
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
                    <img src="{{ asset($user->photo ?? 'default-photo.jpg') }}" alt="Profile Photo"
                        class="profile-photo">
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
                    @if ($bookmarks->isNotEmpty())
                        <h3>Your Bookmarked Animes</h3>
                        <ul class="bookmark-list">
                            @foreach ($bookmarks as $bookmark)
                                <li class="bookmark-item">
                                    <!-- Anime image -->
                                    <img src="{{ asset('storage/' . $bookmark->anime->image) }}" 
                                         alt="Not Found" 
                                         class="img-thumbnail-zoom-in">
                                    <!-- Anime info -->
                                    <div class="anime-info">
                                        <p>{{ $bookmark->anime->name }} - Added on {{ $bookmark->created_at->format('d M Y') }}</p>
                                        <p>Genre {{$bookmark->anime->category->name}} </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>You have no bookmarks yet.</p>
                    @endif
                
                    <h3>Update Profile</h3>
                    <!-- Edit button can be linked to an edit page -->
                    <button class="edit-button" onclick="window.location.href='{{ route('user.edit', $user->id) }}'">
                        Edit Profile
                    </button>
                    <!-- Example link back to anime list -->
                    <a href="{{ route('Anim') }}">
                        <button class="edit-button">Back to Anime List</button>
                    </a>
                </div>                
            </div>
            <div class="profile-card">
                <form action="{{ route('account.delete-account', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="delete-button" type="submit" class="delete-button">Delete Account</button>
                    <p>This action cannot be undone.</p>
                </form>
            </div>
        </div>

</body>

</html>
