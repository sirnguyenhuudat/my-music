    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#">
                <img src="{{ asset(config('image.icon') . 'logo.png') }}" alt="Cool Admin" />
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li>
                        <a href="{{ route('backend.statical') }}">{{ trans('backend_template.statistical') }}</a>
                    </li>
                    <li class="active has-sub">
                        <a class="js-arrow" href="#">{{ trans('backend_template.management') }}</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="{{ route('backend.roles.index') }}">{{ trans('backend_template.role_management') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.permissions.index') }}">{{ trans('backend_template.permission_management') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.access.index') }}">{{ trans('backend_template.access_management') }}</a>
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
                    <li>
                        <a href="{{ route('home') }}">{{ trans('backend_template.home_page') }}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

