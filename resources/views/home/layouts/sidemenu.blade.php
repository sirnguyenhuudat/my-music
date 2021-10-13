<div class="ms_sidemenu_wrapper">
    <div class="ms_nav_close">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
    </div>
    <div class="ms_sidemenu_inner">
        <div class="ms_logo_inner">
            <div class="ms_logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(config('bower.home_images') . '/logo.png') }}" alt="" class="img-fluid"/>
                </a>
            </div>
            <div class="ms_logo_open">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(config('bower.home_images') . '/open_logo.png') }}" alt="" class="img-fluid"/>
                </a>
            </div>
        </div>
        <div class="ms_nav_wrapper">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="active" title="Music Online">
                        <span class="nav_icon">
                            <span class="icon icon_discover"></span>
                        </span>
                        <span class="nav_text">
                            {{ trans('home_index.discover') }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('albums', trans('home_album.url-list-albums')) }}" title="Albums">
                        <span class="nav_icon">
                            <span class="icon icon_albums"></span>
                        </span>
                        <span class="nav_text">
                            {{ trans('home_index.albums') }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('artist.index') }}" title="Artists">
						<span class="nav_icon">
							<span class="icon icon_artists"></span>
						</span>
                        <span class="nav_text">
                            {{ trans('home_index.artists') }}
						</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('genres', trans('home_genre.url-list-genres')) }}" title="Genres">
                        <span class="nav_icon">
                            <span class="icon icon_genres"></span>
                        </span>
                        <span class="nav_text">
                            {{ trans('home_index.genres') }}
                        </span>
                    </a>
                </li>
            </ul>
            @if (Auth::user())
                <ul class="nav_downloads">
                    <li>
                        <a href="{{ route('track.upload') }}" title="Upload">
                            <span class="nav_icon">
                                <span class="icon icon_purchased"></span>
                            </span>
                            <span class="nav_text">
                                {{ trans('home_index.purchased') }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('track.uploaded') }}" title="Track Uploaded">
                            <span class="nav_icon">
                                <span class="icon icon_history"></span>
                            </span>
                            <span class="nav_text">
                                {{ trans('home_index.uploaded') }}
                            </span>
                        </a>
                    </li>
                </ul>
                <ul class="nav_playlist">
                    <li>
                        <a href="{{ route('playlist.get_playlist_by_member') }}" title="Create Playlist">
                            <span class="nav_icon">
                                <span class="icon icon_c_playlist"></span>
                            </span>
                            <span class="nav_text">
                                {{ trans('home_index.create_playlist') }}
                            </span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>

