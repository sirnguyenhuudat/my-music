<div class="ms_weekly_wrapper">
    <div class="ms_weekly_inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="ms_heading">
                    <h1>{{ trans('home_album.top_15') }}</h1>
                </div>
            </div>
            @forelse($top_15_albums as $key => $album)
                @php
                    ++$key;
                @endphp
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
                                        @if($album->picture != '')
                                            <img src="{{ asset(getThumbName($album->artist->avatar)) }}" alt="{{ $album->artist->name }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset(getThumbName(config('image.icon') . 'artist.png')) }}" alt="" class="img-fluid">
                                        @endif
                                        <div class="ms_song_overlay">
                                        </div>
                                        <div class="ms_play_icon">
                                            <img src="{{ asset(config('bower.home_images') . '/svg/play.svg') }}" class="weekly_play_icon" id="{{ $album->id }}" alt="">
                                        </div>
                                    </div>
                                    <div class="w_tp_song_name">
                                        <h3><a href="{{ route('album.detail', ['id' => $album->id, 'url' => $album->slug . '.html']) }}">{{ $album->title }}</a></h3>
                                        <p>{{ $album->artist->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="weekly_right">
                                {{--<span class="w_song_time">{{ $weekly->length }}</span>--}}
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
                                    <a href="#">
                                        <span class="opt_icon"><span class="icon icon_queue"></span></span>{{ trans('home_index.add_to_queue') }}
                                    </a>
                                </li>
                                @if (Auth::user() && count(Auth::user()->playlists) > 0)
                                    <li><a><span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ trans('home_index.add_to_playlist') }}</a>
                                        <ul>
                                            @foreach (Auth::user()->playlists as $playlist)
                                                <li>
                                                    <a href="javascript:void(0)" onclick="document.getElementById('top15_{{ $album->id }}_{{ $playlist->id }}').submit()" target="_blank"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                        {{ $playlist->title }}
                                                    </a>
                                                    <form action="{{ route('playlist.add_album') }}" method="post" id="top15_{{ $album->id }}_{{ $playlist->id }}">
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
