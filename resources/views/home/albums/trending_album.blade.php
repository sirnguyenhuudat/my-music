<div class="ms_rcnt_slider padder_top50">
    <div class="ms_heading">
        <h1>{{ trans('home_album.trending') }}</h1>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @forelse($trending_albums as $album)
                <div class="swiper-slide">
                    <div class="ms_rcnt_box">
                        <div class="ms_rcnt_box_img">
                            @if ($album->picture == '')
                                <img src="{{ asset(config('bower.home_images') . '/album/album1.jpg') }}" alt="">
                            @else
                                <img src="{{ asset(getThumbName($album->picture, 250, 250)) }}" alt="">
                            @endif
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_more_icon">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/more.svg') }}" alt="">
                                </div>
                                <ul class="more_option">
                                    <li>
                                        <a href="#">
                                            <span class="opt_icon"><span class="icon icon_fav"></span></span>{{ trans('home_index.add_to_favourites') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="opt_icon"><span class="icon icon_queue"></span></span>{{ trans('home_index.add_to_queue') }}
                                        </a>
                                    </li>
                                    @if (Auth::user() && count(Auth::user()->playlists) > 0)
                                        <li><a><span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ trans('home_index.add_to_playlist') }}</a>
                                            <ul>
                                                @foreach (Auth::user()->playlists as $playlist)
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="document.getElementById('trending_{{ $album->id }}_{{ $playlist->id }}').submit()" target="_blank"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                            {{ $playlist->title }}
                                                        </a>
                                                        <form action="{{ route('playlist.add_album') }}" method="post" id="trending_{{ $album->id }}_{{ $playlist->id }}">
                                                            @csrf
                                                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                                                            <input type="hidden" name="playlist_id" value="{{ $playlist->id }}">
                                                        </form>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                                <div class="ms_play_icon">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/play.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="ms_rcnt_box_text">
                            <h3><a href="{{ route('album.detail', ['id' => $album->id, 'url' => $album->slug . '.html']) }}">{{ $album->title }}</a></h3>
                            <p>{{ $album->artist->name }}</p>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next slider_nav_next"></div>
    <div class="swiper-button-prev slider_nav_prev"></div>
</div>
