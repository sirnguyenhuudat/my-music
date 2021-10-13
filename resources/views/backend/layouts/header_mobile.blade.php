    <header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{ asset(config('image.icon') . 'logo.png') }}" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="#">{{ trans('backend_template.statistical') }}</a>
                </li>
                <li class="active has-sub">
                    <a class="js-arrow" href="#">{{ trans('backend_template.management') }}</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('backend.roles.index') }}">{{ trans('backend_template.role_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('backend.users.index') }}">{{ trans('backend_template.user_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('backend.genres.index') }}">{{ trans('backend_template.genre_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('backend.artists.index') }}">{{ trans('backend_template.artist_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('backend.tracks.index') }}">{{ trans('backend_template.track_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('backend.albums.index') }}">{{ trans('backend_template.album_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('backend.comments.index') }}">{{ trans('backend_template.comment_management') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
