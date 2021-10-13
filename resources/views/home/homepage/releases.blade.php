<div class="ms_releases_wrapper">
    <div class="ms_heading">
        <h1>{{ trans('home_index.new_releases') }}</h1>
        @if (is_array($release_tracks) && count($release_tracks) > config('conf.ConditionShowMoreItemInPage'))
        <span class="veiw_all"><a href="#">{{ trans('home_index.view_more') }}</a></span>
        @endif
    </div>
    <div class="ms_release_slider swiper-container">
        <div class="ms_divider"></div>
        <div class="swiper-wrapper">
            @forelse($release_tracks as $track)
                <div class="swiper-slide">
                    <div class="ms_release_box">
                        <div class="w_top_song">
                            <span class="slider_dot"></span>
                            <div class="w_tp_song_img">
                                @if($track->artist->avatar == '')
                                    <img src="{{ asset(config('bower.home_images') . '/weekly/song1.jpg') }}" alt="">
                                @else
                                    <img src="{{ asset(getThumbName($track->artist->avatar)) }}" alt="">
                                @endif
                                <div class="ms_song_overlay">
                                </div>
                                <div class="ms_play_icon">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/play.svg') }}" class="weekly_play_icon" id="{{ $track->id }}" alt="">
                                </div>
                            </div>
                            <div class="w_tp_song_name">
                                <h3><a href="{{ route('track.index', ['id' => $track->id, 'url' => $track->slug . '.html',]) }}">{{ $track->name }}</a></h3>
                                <p>{{ $track->artist->name }}</p>
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
    @if (is_array($release_tracks) && count($release_tracks) > config('conf.ConditionShowMoreItemInPage'))
    <div class="swiper-button-next2 slider_nav_next"></div>
    <div class="swiper-button-prev2 slider_nav_prev"></div>
    @endif
</div>
