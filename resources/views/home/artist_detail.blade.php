@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <!-- Header -->
    @include('home.homepage.header')
    <!-- Album Single Section Start-->
    <!-- Album Single Section Start-->
    <div class="ms_album_single_wrapper ms_artist_single">
        <div class="album_single_data">
            <div class="album_single_img">
                @if($artist->avatar == '')
                <img src="{{ asset(config('bower.home_images') . 'artist/artist' . rand(1, 13) . '.jpg') }}" alt="" class="img-fluid">
                @else
                @endif
            </div>
            <div class="album_single_text">
                <h2>{{ $artist->name }}</h2>
                <p class="singer_name">{{ $artist->year_active }} {{ trans('home_artist.year_active') }}</p>
                @php
                    $albumsOfArtist = $artist->albums;
                @endphp
                @if(count($albumsOfArtist) > 0)
                <p>
                    {{ count($albumsOfArtist) }} {{ trans('home_artist.albums') }}:
                    @foreach($albumsOfArtist as $album)
                        <a href="{{ route('album.detail', ['id' => $album->id, 'url' => $album->slug . '.html']) }}">{{ $album->title }}</a>,
                    @endforeach
                </p>
                @endif
                <div class="about_artist">
                    @php
                        $info = str_replace("\r\n", "<br/>", $artist->info);
                    @endphp
                    {!! $info !!}
                </div>
            </div>
        </div>
        <!-- Song List -->
        <div class="album_inner_list">
            <div class="album_list_wrapper">
                <ul class="album_list_name">
                    <li>#</li>
                    <li>{{ trans('home_album.song_title') }}</li>
                    <li class="text-center">{{ trans('home_album.month_view') }}</li>
                    <li class="text-center">{{ trans('home_index.add_to_favourites') }}</li>
                    <li class="text-center">{{ trans('home_album.more') }}</li>
                </ul>
                @forelse($artist->tracks as $key => $track)
                    <ul>
                        <li><a href="javascript:void(0)" class="weekly_play_icon" id="{{ $track->id }}"><span class="play_no">{{ ++$key }}</span><span class="play_hover"></span></a></li>
                        <li><a href="{{ route('track.index', ['id' => $track->id, 'url' => $track->slug . '.html',]) }}">{{ $track->name }}</a></li>
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
                                                    <a href="javascript:void(0)" onclick="document.getElementById('{{ $playlist->id }}_{{ $track->id }}').submit()"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                        {{ $playlist->title }}
                                                    </a>
                                                    <form action="{{ route('playlist.add_track', ['playlist_id' => $playlist->id, 'track_id' => $track->id,]) }}" method="get" id="{{ $playlist->id }}_{{ $track->id }}">
                                                        @csrf
                                                    </form>
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
    <!---Main Content Start--->
    @if(count($similarArtists) > 0)
    <div class="ms_content_wrapper ms_artist_content">
        <div class="ms_featured_slider">
            <div class="ms_heading">
                <h1>{{ trans('home_artist.similar') }}</h1>
            </div>
            <div class="ms_relative_inner">
                <div class="ms_feature_slider swiper-container">
                    <div class="swiper-wrapper">
                        @forelse($similarArtists as $artist)
                        <div class="swiper-slide">
                            <div class="ms_rcnt_box">
                                <div class="ms_rcnt_box_img">
                                    @if($artist->avatar == '')
                                        <img src="{{ asset(config('bower.home_images') . 'radio/img' . rand(1, 13) . '.jpg') }}" alt="" class="img-fluid">
                                    @else
                                        <img src="{{ getThumbName($artist->avatar, 250, 250) }}" alt="" class="img-fluid">
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
                <div class="swiper-button-next1 slider_nav_next"></div>
                <div class="swiper-button-prev1 slider_nav_prev"></div>
            </div>
        </div>
    </div>
    @endif
    <!-- Audio Player Section -->
    @include('home.layouts.player')
    @include('home.layouts.extends');
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/artist_detail.css') }}">
@endsection

