@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <!-- Header -->
    @include('home.homepage.header')
    <!-- Album Single Section Start-->
    <div class="ms_album_single_wrapper">
        <div class="album_single_data">
            <div class="album_single_img">
                <img src="{{ asset(config('bower.home_images') . '/radio/img13.jpg') }}" alt="">
            </div>
            <div class="album_single_text">
                <h2>{{ $title_page }}</h2>
                <div class="album_feature">
                    <a href="#" class="album_date">{{ count($trending) }} {{ trans('home_album.songs') }}</a>
                </div>
                <div class="album_btn">
                    <a href="#" class="ms_btn play_btn"><span class="play_all"><img src="{{ asset(config('bower.home_images') . 'svg/play_all.svg') }}" alt="">{{ trans('home_album.play_all') }}</span><span class="pause_all"><img src="{{ asset(config('bower.home_images') . 'svg/pause_all.svg') }}" alt="">{{ trans('home_album.pause') }}</span></a>
                    <a href="#" class="ms_btn"><span class="play_all"><img src="{{ asset(config('bower.home_images') . 'svg/add_q.svg') }}" alt="">{{ trans('home_album.add_to_queue') }}</span></a>
                </div>
            </div>
            <div class="album_more_optn ms_more_icon">
                <span><img src="{{ asset(config('bower.home_images') . 'svg/more.svg') }}" alt=""></span>
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
                                    <a href="#" target="_blank"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                        {{ $playlist->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!--Song List-->
        <div class="album_inner_list">
            <div class="album_list_wrapper">
                <ul class="album_list_name">
                    <li>#</li>
                    <li>{{ trans('home_album.song_title') }}</li>
                    <li>{{ trans('home_album.artist') }}</li>
                    <li class="text-center">{{ trans('home_album.month_view') }}</li>
                    <li class="text-center">{{ trans('home_index.add_to_favourites') }}</li>
                    <li class="text-center">{{ trans('home_album.more') }}</li>
                </ul>
                @forelse($trending as $key => $track)
                    <ul>
                        <li><a href="javascript:void(0)" class="weekly_play_icon" id="{{ $track->id }}"><span class="play_no">{{ ++$key }}</span><span class="play_hover"></span></a></li>
                        <li><a href="{{ route('track.index', ['id' => $track->id, 'url' => $track->slug . '.html',]) }}">{{ $track->name }}</a></li>
                        <li><a href="#">{{ $track->artist->name }}</a></li>
                        <li class="text-center"><a href="#">{{ $track->month_view }}</a></li>
                        <li class="text-center"><a href="#"><span class="ms_icon1 ms_fav_icon"></span></a></li>
                        <li class="text-center ms_more_icon"><a href="javascript:;"><span class="ms_icon1 ms_active_icon"></span></a>
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
                                                    <a href="{{ route('playlist.add_track', ['playlist_id' => $playlist->id, 'track_id' => $track->id,]) }}" target="_blank"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                        {{ $playlist->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <!-- Audio Player Section -->
    @include('home.layouts.player')
    @include('home.layouts.extends');
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/trending.css') }}">
@endsection
