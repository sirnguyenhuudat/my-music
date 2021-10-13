        <div class="ms_rcnt_slider">
            <div class="ms_heading">
                <h1>{{ trans('home_index.recently_played') }}</h1>
                <span class="veiw_all"><a href="#">{{ trans('home_index.view_more') }}</a></span>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($tracks_recently as $track)
                        <div class="swiper-slide">
                            <div class="ms_rcnt_box">
                                <div class="ms_rcnt_box_img">
                                    <img src="{{ asset(config('bower.home_images') . '/music/r_music1.jpg') }}" alt="">
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_play_icon">
                                            <a href="javascript:void(0)" class="weekly_play_icon" id="{{ $track->id }}"><img src="{{ asset(config('bower.home_images') . '/svg/play.svg') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href="{{ route('track.index', ['id' => $track->id, 'url' => $track->slug . '.html',]) }}">{{ $track->name }}</a></h3>
                                    <p>{{ $track->artist->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next slider_nav_next"></div>
            <div class="swiper-button-prev slider_nav_prev"></div>
        </div>
