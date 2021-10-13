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
                @if($genre->picture == '')
                    <img src="{{ asset(config('bower.home_images') . '/genrs/img18.jpg') }}" alt="">
                @else
                    <img src="{{ asset(getThumbName($genre->avatar, 250, 250)) }}" alt="">
                @endif
            </div>
            <div class="album_single_text">
                <h2>{{ $genre->name }}</h2>
                <div class="album_feature">
                    <a href="#" class="album_date">{{ count($genre->tracks) }} {{ trans('home_album.songs') }}</a>
                </div>
            </div>
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
                @forelse($tracks as $key => $track)
                    <ul>
                        <li><a href="javascript:void(0)" class="weekly_play_icon" id="{{ $track->track_id }}"><span class="play_no">{{ ++$key }}</span><span class="play_hover"></span></a></li>
                        <li><a href="{{ route('track.index', ['id' => $track->track_id, 'url' => $track->track_slug . '.html',]) }}">{{ $track->track_name }}</a></li>
                        <li><a href="#">{{ $track->artist_name }}</a></li>
                        <li class="text-center"><a href="#">{{ $track->month_view }}</a></li>
                        <li class="text-center"><a href="#"><span class="ms_icon1 ms_fav_icon"></span></a></li>
                        <li class="text-center ms_more_icon"><span class="ms_icon1 ms_active_icon"></span>
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
                                            @foreach(Auth::user()->playlists as $playlist)
                                                <li>
                                                    <a href="javascript:void(0)" onclick="document.getElementById('{{ $playlist->id }}_{{ $track->track_id }}').submit()"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                        {{ $playlist->title }}
                                                    </a>
                                                    <form action="{{ route('playlist.add_track', ['playlist_id' => $playlist->id, 'track_id' => $track->track_id,]) }}" method="get" id="{{ $playlist->id }}_{{ $track->track_id }}">
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
        <br>
        {{ $tracks->links() }}
    </div>
    <!-- Audio Player Section -->
    @include('home.layouts.player')
    @include('home.layouts.extends');
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/genre_detail.css') }}">
@endsection
