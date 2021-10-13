<div class="ms_weekly_wrapper">
    <div class="ms_weekly_inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="ms_heading">
                    <h1>{{ trans('home_index.weekly_top_15') }}</h1>
                </div>
            </div>
            @forelse($weekly_top_15 as $key => $trackOfWeek)
                <?php ++$key;?>
                @if($key == 1 || $key == 6)
                    <div class="col-lg-4 col-md-12 padding_right40">
                @endif
                @if($key == 11)
                    <div class="col-lg-4 col-md-12 padding_right40">
                @endif
                        <div class="ms_weekly_box">
                            <div class="weekly_left">
                                <span class="w_top_no">
                                    {{ $key }}
                                </span>
                                <div class="w_top_song">
                                    <div class="w_tp_song_img">
                                        @if($trackOfWeek->artist->avatar != '')
                                            <img src="{{ asset(getThumbName($trackOfWeek->artist->avatar)) }}" alt="{{ $trackOfWeek->artist->name }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset(getThumbName(config('image.icon') . 'artist.png')) }}" alt="" class="img-fluid">
                                        @endif
                                        <div class="ms_song_overlay">
                                        </div>
                                        <div class="ms_play_icon">
                                            <img src="{{ asset(config('bower.home_images') . '/svg/play.svg') }}" class="weekly_play_icon" id="{{ $trackOfWeek->id }}" alt="">
                                        </div>
                                    </div>
                                    <div class="w_tp_song_name">
                                        <h3><a href="{{ route('track.index', ['id' => $trackOfWeek->id, 'url' => $trackOfWeek->slug . '.html',]) }}">{{ $trackOfWeek->name }}</a></h3>
                                        <p>{{ $trackOfWeek->artist->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="weekly_right">
                                <span class="ms_more_icon" data-other="1">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/more.svg') }}" alt="">
                                </span>
                            </div>
                            <ul class="more_option">
                                <li>
                                    <a href="#">
                                        <span class="opt_icon"><span class="icon icon_fav"></span></span>{{ trans('home_index.add_to_favourites') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="add_to_queue" attr-id="{{ $trackOfWeek->id }}">
                                        <span class="opt_icon"><span class="icon icon_queue"></span></span>{{ trans('home_index.add_to_queue') }}
                                    </a>
                                </li>
                                @if (Auth::user() && count(Auth::user()->playlists) > 0)
                                    <li><a><span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ trans('home_index.add_to_playlist') }}</a>
                                        <ul>
                                            @foreach(Auth::user()->playlists as $playlist)
                                                <li>
                                                    <a href="{{ route('playlist.add_track', ['playlist_id' => $playlist->id, 'track_id' => $trackOfWeek->id,]) }}" target="_blank"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                        {{ $playlist->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="ms_divider"></div>
                @if($key == 5 || $key == 10 || $key == 15)
                    </div>
                @endif
            @empty
            @endforelse
        </div>
    </div>
</div>
