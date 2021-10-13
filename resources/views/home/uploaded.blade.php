@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <div class="ms_weekly_wrapper">
            <div class="ms_weekly_inner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ms_heading">
                            <h1>{{ trans('home_track.uploaded') }}</h1>
                        </div>
                    </div>
                    @forelse($tracks as $key => $track)
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
                                                @if($track->artist->avatar != '')
                                                    <img src="{{ asset(getThumbName($track->artist->avatar)) }}" alt="{{ $track->artist->name }}" class="img-fluid">
                                                @else
                                                    <img src="{{ asset(getThumbName(config('image.icon') . 'artist.png')) }}" alt="" class="img-fluid">
                                                @endif
                                                <div class="ms_song_overlay"></div>
                                                <div class="ms_play_icon">
                                                    <img src="{{ asset(config('bower.home_images') . '/svg/play.svg') }}" class="weekly_play_icon" id="{{ $track->id }}" alt="">
                                                </div>
                                            </div>
                                            <div class="w_tp_song_name">
                                                <h3><a href="{{ route('track.index', ['id' => $track->id, 'url' => $track->slug . '.html',]) }}">{{ $track->name }}</a></h3>
                                                <p>{{ $track->artist->name }}</p>
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
                                                    @foreach(Auth::user()->playlists as $playlist)
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
        <div>
            {{ $tracks->links() }}
        </div>
    </div>
@endsection

@section ('style')
@endsection

@section('script')
@endsection

