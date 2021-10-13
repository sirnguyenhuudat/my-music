@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <!-- Play list -->
        <div class="ms_top_artist">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show col-lg-3">
                        <span class="badge badge-pill badge-success">{{ trans('backend_artist.label_success') }}</span>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <br/>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ms_heading">
                            <h1>{{ trans('home_playlist.your_playlist') }}</h1>
                        </div>
                    </div>
                    @forelse($playlists as $playlist)
                        <div class="col-lg-2 col-md-6">
                            <div class="ms_rcnt_box marger_bottom25">
                                <div class="ms_rcnt_box_img">
                                    <img src="{{ asset(config('bower.home_images') . 'radio/img2.jpg') }}" alt="" class="img-fluid">
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_play_icon">
                                            <img src="{{ asset(config('bower.home_images') . 'svg/play.svg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href="{{ route('playlist.show', ['id' => $playlist->id, 'url' => $playlist->slug . '.html']) }}">{{ $playlist->title }}</a></h3>
                                    <p>{{ count($playlist->tracks) }} {{ trans('home_playlist.songs') }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    <div class="col-lg-2">
                        <div class="ms_rcnt_box marger_bottom25">
                            <div class="create_playlist">
                                <i class="ms_icon icon_playlist"></i>
                            </div>
                            <div class="ms_rcnt_box_text">
                                <h3><a href="#" data-toggle="modal" data-target="#modalCreatePlaylist">{{ trans('home_playlist.create') }}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div id="modalCreatePlaylist" class="modal  centered-modal" role="dialog">
    <div class="modal-dialog login_dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">
                <i class="fa_icon form_close"></i>
            </button>
            <div class="modal-body">
                <div class="ms_register_img">
                    <img src="{{ asset(config('bower.home_images') . '/register_img.png') }}" alt="" class="img-fluid"/>
                </div>
                <div class="ms_register_form">
                    <form method="post" action="{{ route('playlist.store') }}" id="form_playlist_create">
                        @csrf
                        <h2>{{ trans('home_playlist.create') }}</h2>
                        <div class="form-group">
                            <input id="playlist" type="text" class="au-input au-input--full form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="email" autofocus placeholder="{{ trans('home_playlist.enter_your_playlist') }}">
                            <span class="form_icon">
                                    <i class="fa_icon form-user" aria-hidden="true"></i>
                                </span>
                            <small class="form-text text-muted">{{ $errors->first('title') }}</small>
                        </div>
                        <div class="form-group row mb-0">
                            <a href="javascript:void(0)" class="ms_btn" onclick="event.preventDefault(); document.getElementById('form_playlist_create').submit()">
                                {{ trans('home_playlist.submit') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section ('style')
    @error('title')
        <link rel="stylesheet" href="{{ asset('css/frontend/playlist.css') }}">
    @enderror
@endsection

@section('script')
    @error('title')
        <script src="{{ asset('js/frontend/playlist.js') }}"></script>
    @enderror
@endsection
