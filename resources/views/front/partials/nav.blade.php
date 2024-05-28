<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JournalismAI</title>
    <link rel="stylesheet" href="/css/nav.css">
    <script src="/js/nav.js"></script>
</head>

<nav class="top-bar">
    <div>
        <img src="/images/logo.png" alt="JournalistAI Logo" class="logo">
    </div>
    <a class="title">JournalismAI</a>
    <div class="profile-container">
        <img src="{{ Auth::user()->avatar }}" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
        <div class="dropdown-menu" id="dropdownMenu">
            <a href="{{ route('edit_profile') }}">Edit</a>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>