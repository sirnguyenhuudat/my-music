<div class="ms_releases_wrapper">
    <div class="ms_heading">
        <h1>{{ trans('home_album.released_albums') }}</h1>
    </div>
    <div class="ms_release_slider swiper-container">
        <div class="ms_divider"></div>
        <div class="swiper-wrapper">
            @forelse($release_albums as $album)
                <div class="swiper-slide">
                    <div class="ms_release_box">
                        <div class="w_top_song">
                            <span class="slider_dot"></span>
                            <div class="w_tp_song_img">
                                @if($album->picture == '')
                                    <img src="{{ asset(config('bower.home_images') . '/weekly/song1.jpg') }}" alt="">
                                @else
                                    <img src="{{ asset(getThumbName($album->picture)) }}" alt="">
                                @endif
                                <div class="ms_song_overlay">
                                </div>
                                <div class="ms_play_icon">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/play.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="w_tp_song_name">
                                <h3><a href="{{ route('album.detail', ['id' => $album->id, 'url' => $album->slug . '.html']) }}">{{ $album->title }}</a></h3>
                                <p>{{ $album->artist->name }}</p>
                            </div>
                        </div>
                        <div class="weekly_right">
                            {{--<span class="w_song_time">{{ $release->length }}</span>--}}
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next2 slider_nav_next"></div>
    <div class="swiper-button-prev2 slider_nav_prev"></div>
</div>

