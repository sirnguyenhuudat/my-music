@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <div class="ms_upload_wrapper marger_top60">
            <form action="{{ route('track.upload_track') }}" method="post" enctype="multipart/form-data" id="uploadTrack">
                @csrf
                <div class="ms_upload_box">
                    <h2>{{ trans('home_track.title_upload') }}</h2>
                    <img src="{{ asset(config('bower.home_images') . 'svg/upload.svg') }}" alt="">
                    <div class="ms_upload_btn">
                        <input type="file" name="file" class="@error('file') is-invalid @enderror">
                    </div>
                    @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class=" marger_top60">
                    <div class="ms_upload_box">
                        <div class="ms_heading">
                            <h1>{{ trans('home_track.track_info') }}</h1>
                        </div>
                        <div class="ms_pro_form">
                            <div class="form-group">
                                <label>{{ trans('home_track.track_name') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if(count($artists) > 0)
                                <div class="form-group">
                                    <label>{{ trans('home_track.artist_name') }}</label>
                                    <select name="artist_id"class="form-control @error('artist_id') is-invalid @enderror" >
                                        @forelse($artists as $artist)
                                            <option value="0">{{ trans('home_track.choose_artist') }}</option>
                                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('artist_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @endif
                            <div class="form-group">
                                <label>{{ trans('home_track.author') }}</label>
                                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror">
                                @error('author')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="pro-form-btn text-center marger_top15">
                                <div class="ms_upload_btn">
                                    <a href="#" class="ms_btn" onclick="document.getElementById('uploadTrack').submit()">{{ trans('home_track.upload_now') }}</a>
                                    <a href="#" class="ms_btn">{{ trans('home_track.cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section ('style')
@endsection

@section('script')
@endsection

