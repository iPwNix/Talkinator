<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{ route('editInfo', $user->username) }}">
                Edit Info
            </a>
            <a class="nav-item nav-link" href="{{ route('editAvatar', $user->username) }}">
                Edit Avatar
            </a>
            <a class="nav-item nav-link" href="{{ route('editCover', $user->username) }}">
                Edit Cover
            </a>
        </div>
    </div>
</nav>