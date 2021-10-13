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
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.albums.index') }}">{{ trans('backend_album.label') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="card">
                            <div class="card-header">
                                {!! trans('backend_album.label_form_update') !!}
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('backend.albums.update', $album->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group {{ $errors->has('title') ? 'has-warning' : '' }}">
                                                <label class=" form-control-label">{{ trans('backend_album.form_title') }}</label>
                                                <small class="form-text text-muted">{{ $errors->first('title') }}</small>
                                                <input type="text" class="form-control-success form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ $album->title }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group {{ $errors->has('artist_id') ? 'has-warning' : '' }}">
                                                        <label class=" form-control-label">{{ trans('backend_album.td_artist') }}</label>
                                                        <small class="form-text text-muted">{{ $errors->first('artist_id') }}</small>
                                                        <select name="artist_id" class="form-control {{ $errors->has('artist_id') ? 'is-invalid' : '' }}">
                                                            <option value="0">{{ trans('backend_album.updating') }}</option>
                                                            @forelse($artists as $artist)
                                                                <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group {{ $errors->has('genre_id') ? 'has-warning' : '' }}">
                                                        <label class=" form-control-label">{{ trans('backend_album.td_genre') }}</label>
                                                        <small class="form-text text-muted">{{ $errors->first('genre_id') }}</small>
                                                        <select name="genre_id" class="form-control {{ $errors->has('genre_id') ? 'is-invalid' : '' }}">
                                                            <option value="0">{{ trans('backend_album.updating') }}</option>
                                                            @forelse($genres as $genre)
                                                                <option value="{{ $genre->id }}" {{ $album->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($album->picture)
                                        <div class="form-group">
                                            <label class="form-control-label">{{ trans('backend_artist.old_image') }}</label>
                                            <img src="{{ asset(getThumbName($album->picture, 250, 250)) }}" alt="avatar" class="img-thumbnail">
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group {{ $errors->has('picture') ? 'has-warning' : '' }}">
                                                <label class=" form-control-label">{{ trans('backend_album.form_picture') }}</label>
                                                <small class="form-text text-muted">{{ $errors->first('picture') }}</small>
                                                <input type="file" class="form-control-success form-control {{ $errors->has('picture') ? 'is-invalid' : '' }}" name="picture">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group {{ $errors->has('relate_date') ? 'has-warning' : '' }}">
                                                <label class=" form-control-label">{{ trans('backend_album.td_relate_date') }}</label>
                                                <small class="form-text text-muted">{{ $errors->first('relate_date') }}</small>
                                                <input type="text" class="form-control-success form-control {{ $errors->has('relate_date') ? 'is-invalid' : '' }}" name="relate_date" id="relate_date" value="{{ $album->relate_date }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('tracks.*') ? 'has-warning' : '' }}">
                                        <label class="form-control-label">{{ trans('backend_album.tracks_of_album') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('tracks.*') }}</small>
                                        <select name="tracks[]" class="album_search_track_multi form-control {{ $errors->has('tracks.*') ? 'is-invalid' : '' }}" multiple="multiple">
                                            @forelse ($tracks as $key => $track)
                                                @forelse($album->tracks as $trackInAlbum)
                                                    <option value="{{ $track->id }}" {{ $trackInAlbum->id == $track->id ? 'selected' : '' }}>{{ ++$key . ' . ' . $track->name . ' - ' . $track->artist->name }}</option>
                                                @empty
                                                    <option value="{{ $track->id }}">{{ ++$key . ' . ' . $track->name . ' - ' . $track->artist->name }}</option>
                                                @endforelse
                                            @empty
                                                <option value="0">{{ trans('backend_album.empty_genre') }}</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('info') ? 'has-warning' : 'has-success' }}">
                                        <label class=" form-control-label">{{ trans('backend_album.info') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('info') }}</small>
                                        <textarea name="info" id="albumEditor" class="form-control {{ $errors->has('info') ? 'is-invalid' : '' }}">{{ $album->info }}</textarea>
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
    <link rel="stylesheet" href="{{ asset(config('bower.datepicker') . 'jquery-ui.css') }}">
@endsection

@section ('script')
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'backend_script.js') }}"></script>
    <script type="text/javascript" src="{{ asset(config('bower.datepicker') . 'jquery-ui.js') }}"></script>
    <script>
        $(function () {
            $('#relate_date').datepicker();
        });
    </script>
@endsection
