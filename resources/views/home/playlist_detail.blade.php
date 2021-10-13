@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    {{-- HEADER --}}
    @include('home.homepage.header')
    {{-- Playlist --}}
    <div class="ms_album_single_wrapper">
        <div class="album_single_data">
            @if (session('success'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">{{ trans('backend_artist.label_success') }}</span>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            <div class="album_single_text">
                <h2>{{ $playlist->title }}</h2>
                <p class="singer_name">{{ trans('home_album.by') }}{{ $playlist->user->name }}</p>
                <div class="album_feature">
                    <a href="#" class="album_date">{{ count($playlist->tracks) }} {{ trans('home_playlist.tracks') }}</a>
                    <a href="#" class="album_date">{{ trans('home_album.released') }}{{ $playlist->created_at->diffforHumans() }}</a>
                </div>
                <div class="album_btn">
                    <a href="#" class="ms_btn play_btn"><span class="play_all"><img src="{{ asset(config('bower.home_images') . 'svg/play_all.svg') }}" alt="">{{ trans('home_album.play_all') }}</span><span class="pause_all"><img src="{{ asset(config('bower.home_images') . 'svg/pause_all.svg') }}" alt="">{{ trans('home_album.pause') }}</span></a>
                    <a href="#" class="ms_btn"><span class="play_all"><img src="{{ asset(config('bower.home_images') . 'svg/add_q.svg') }}" alt="">{{ trans('home_album.add_to_queue') }}</span></a>
                    @if(Auth::id() === $playlist->user_id)
                        <a href="#" class="ms_btn delete_playlist" onclick="event.preventDefault(); !window.confirm('{{ trans('home_playlist.delete_playlist', ['title' => $playlist->title,]) }}') ? false : document.getElementById('delete_playlist').submit()"><span class="delete">{{ trans('home_playlist.delete') }}</span></a>
                        <form action="{{ route('playlist.destroy', $playlist->id) }}" method="post" id="delete_playlist">
                            @csrf
                            @method('delete')
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <!-- Song List-->
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
                @forelse($playlist->tracks as $key => $track)
                    <ul>
                        <li><a href="#" class="weekly_play_icon" id="{{ $track->id }}"><span class="play_no">{{ ++$key }}</span><span class="play_hover" ></span></a></li>
                        <li><a href="{{ route('track.index', ['id' => $track->id, 'url' => $track->slug . '.html',]) }}">{{ $track->name }}</a></li>
                        <li><a href="#">{{ $track->artist->name }}</a></li>
                        <li class="text-center"><a href="#">{{ $track->month_view }}</a></li>
                        <li class="text-center"><a href="#"><span class="ms_icon1 ms_fav_icon"></span></a></li>
                        <li class="text-center ms_more_icon"><a href="javascript:;"><span class="ms_icon1 ms_active_icon"></span></a>
                            <ul class="more_option">
                                <li>
                                    <a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>{{ trans('home_index.add_to_favourites') }}</a>
                                </li>
                                @if(Auth::id() === $playlist->user_id)
                                    <li>
                                        <a href="javascript:void(0)" onclick="!window.confirm('{{ trans('home_playlist.alert_remove_track', ['track' => $track->name, 'playlist' => $playlist->title,]) }}') ? false : document.getElementById('remove_track_{{ $track->id }}').submit()"><span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ trans('home_playlist.remove_track_to_playlist') }}</a>
                                        <form action="{{ route('playlist.remove_track', ['playlist_id' => $playlist->id, 'track_id' => $track->id,]) }}" id="remove_track_{{ $track->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </li>
                                @endif
                                @if (Auth::id() !== $playlist->user_id && Auth::user())
                                    <li><a><span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ trans('home_index.add_to_playlist') }}</a>
                                        <ul>
                                            @forelse(Auth::user()->playlists as $playlistGuest)
                                                <li>
                                                    <a href="javascript:void(0)" onclick="document.getElementById('{{ $playlistGuest->id }}_{{ $track->id }}').submit()"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                        {{ $playlistGuest->title }}
                                                    </a>
                                                    <form action="{{ route('playlist.add_track', ['playlist_id' => $playlistGuest->id, 'track_id' => $track->id,]) }}" method="get" id="{{ $playlistGuest->id }}_{{ $track->id }}">
                                                        @csrf
                                                    </form>
                                                </li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </li>
                                @endif
                                @if (Auth::id() === $playlist->user_id && Auth::user() && count(Auth::user()->playlists) > 1)
                                    <li><a><span class="opt_icon"><span class="icon icon_playlst"></span></span>{{ trans('home_index.add_to_playlist') }}</a>
                                        <ul>
                                            @foreach(Auth::user()->playlists as $playlistOwner)
                                                @if($playlistOwner->id != $playlist->id)
                                                <li>
                                                    <a href="javascript:void(0)" onclick="document.getElementById('owner_{{ $playlistOwner->id }}_{{ $track->id }}').submit()"><span class="opt_icon"><span class="icon icon_playlst"></span></span>
                                                        {{ $playlistOwner->title }}
                                                    </a>
                                                    <form action="{{ route('playlist.add_track', ['playlist_id' => $playlistOwner->id, 'track_id' => $track->id,]) }}" method="get" id="owner_{{ $playlistOwner->id }}_{{ $track->id }}">
                                                        @csrf
                                                    </form>
                                                </li>
                                                @endif
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
    @include('home.layouts.player')
    @include('home.layouts.extends')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/playlist_detail.css') }}">
@endsection
