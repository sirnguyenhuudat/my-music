<div class="ms_featured_slider">
    <div class="ms_heading">
        <h1>{{ trans('home_index.featured_artists') }}</h1>
        @if (is_array($featured_artists) && count($featured_artists) > config('conf.ConditionShowMoreItemInPage'))
        <span class="veiw_all"><a href="#">{{ trans('home_index.view_more') }}</a></span>
        @endif
    </div>
    <div class="ms_feature_slider swiper-container">
        <div class="swiper-wrapper">
            @forelse($featured_artists as $artist)
                <div class="swiper-slide">
                    <div class="ms_rcnt_box">
                        <div class="ms_rcnt_box_img">
                            @if($artist->avatar == '')
                                <img src="{{ asset(config('bower.home_images') . '/featured/song1.jpg') }}" alt="">
                            @else
                                <img src="{{ asset(getThumbName($artist->avatar, 250, 250)) }}" alt="">
                            @endif
                        </div>
                        <div class="ms_rcnt_box_text">
                            <h3><a href="{{ route('artist.show', ['id' => $artist->id, 'url' => $artist->slug . '.html',]) }}">{{ $artist->name }}</a></h3>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <!-- Add Arrows -->
    @if (is_array($featured_artists) && count($featured_artists) > config('conf.ConditionShowMoreItemInPage'))
    <div class="swiper-button-next1 slider_nav_next"></div>
    <div class="swiper-button-prev1 slider_nav_prev"></div>
    @endif
</div>

