@extends ('backend.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section ('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">{{ $title_page }}</h2>
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.tracks.index') }}">{{ trans('backend_track.label') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="card">
                            <div class="card-header">
                                {!! trans('backend_track.label_form_update') !!}
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('backend.tracks.update', $track->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="form-group {{ $errors->has('name') ? 'has-warning' : 'has-success' }} col-lg-6">
                                            <label class=" form-control-label">{{ trans('backend_track.form_name') }}</label>
                                            <small class="form-text text-muted">{{ $errors->first('name') }}</small>
                                            <input type="text" class="form-control-success form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $track->name }}">
                                        </div>
                                        <div class="form-group {{ $errors->has('author') ? 'has-warning' : 'has-success' }} col-lg-3">
                                            <label class=" form-control-label">{{ trans('backend_track.form_author') }}</label>
                                            <small class="form-text text-muted">{{ $errors->first('author') }}</small>
                                            <input type="text" class="form-control-success form-control {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author" value="{{ $track->author }}">
                                        </div>
                                        <div class="form-group {{ $errors->has('artist') ? 'has-warning' : 'has-success' }} col-lg-3">
                                            <label class=" form-control-label">{{ trans('backend_track.td_artist') }}</label>
                                            <small class="form-text text-muted">{{ $errors->first('artist') }}</small>
                                            <select name="artist_id" class="form-control {{ $errors->has('artist') ? 'is-invalid' : '' }}">
                                                <option value="0">{{ trans('backend_track.empty_artist') }}</option>
                                                @forelse($artists as $artist)
                                                    <option value="{{ $artist->id }}" {{ $track->artist_id == $artist->id ? 'selected' : ''}}>{{ $artist->name }}</option>
                                                @empty
                                                    <option value="0">{{ trans('backend_track.empty_artist') }}</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group {{ $errors->has('path') ? 'has-warning' : 'has-success' }} col-lg-8">
                                            <label class=" form-control-label">{{ trans('backend_track.form_path') }}</label>
                                            <small class="form-text text-muted">{{ $errors->first('path') }}</small>
                                            <input type="text" class="form-control-success form-control {{ $errors->has('path') ? 'is-invalid' : '' }}" name="path" value="{{ $track->path }}">
                                        </div>
                                        <div class="form-group {{ $errors->has('source') ? 'has-warning' : '' }} col-lg-4">
                                            <label class=" form-control-label">{{ trans('backend_track.form_source') }}</label>
                                            <small class="form-text text-muted">{{ $errors->first('source') }}</small>
                                            <select name="source" class="form-control">
                                                <option value="nhaccuatui" {{ $track->source == 'nhaccuatui' ? 'selected' : '' }}>{{ trans('backend_track.nhaccuatui') }}</option>
                                                <option value="nhacvn" {{ $track->source == 'nhacvn' ? 'selected' : '' }}>{{ trans('backend_track.nhacvn') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('lyric') ? 'has-warning' : 'has-success' }}">
                                        <label class=" form-control-label">{{ trans('backend_track.form_lyric') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('lyric') }}</small>
                                        <textarea name="lyric" id="trackEditor" class="form-control {{ $errors->has('lyric') ? 'is-invalid' : '' }}" cols="30" rows="10">{{ $track->lyric }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">{{ trans('backend_track.form_genres') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('genres.*') }}</small>
                                        <select name="genres[]" class="track_search_genre_multi" multiple="multiple">
                                            @forelse ($genres as $genre)
                                                @forelse ($track->genres as $genreOfArtist)
                                                    <option value="{{ $genre->id }}" {{ $genreOfArtist->id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                                                @empty
                                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                                @endforelse
                                            @empty
                                                <option value="0">{{ trans('backend_track.empty_genre') }}</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('style')
    <link rel="stylesheet" href="{{ asset(config('bower.css') . 'select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset(config('bower.css') . 'backend_style.css') }}">
@endsection

@section ('script')
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'backend_script.js') }}"></script>
@endsection
