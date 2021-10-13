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
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.artists.index') }}">{{ trans('backend_artist.label') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="card">
                            <div class="card-header">
                                {!! trans('backend_artist.label_form') !!}
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('backend.artists.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group {{ $errors->has('name') ? 'has-warning' : '' }}">
                                        <label class=" form-control-label">{{ trans('backend_artist.form_name') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('name') }}</small>
                                        <input type="text" class="form-control-success form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group {{ $errors->has('avatar') ? 'has-warning' : '' }}">
                                        <label class=" form-control-label">{{ trans('backend_artist.form_avatar') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('avatar') }}</small>
                                        <input type="file" class="form-control-success form-control {{ $errors->has('picture') ? 'is-invalid' : '' }}" name="avatar">
                                    </div>
                                    <div class="form-group {{ $errors->has('name') ? 'has-warning' : 'has-success' }}">
                                        <label class=" form-control-label">{{ trans('backend_artist.form_info') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('info') }}</small>
                                        <textarea name="info" id="artistEditor" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30" rows="10">{{ old('info') }}</textarea>
                                    </div>
                                    <div class="form-group {{ $errors->has('year_active') ? 'has-warning' : '' }}">
                                        <label class="form-control-label">{{ trans('backend_artist.year_active') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('year_active') }}</small>
                                        <select name="year_active" class="form-control">
                                            @for ($i = 0; $i <= 50; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">{{ trans('backend_artist.form_genres') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('genres.*') }}</small>
                                        <select name="genres[]" class="artist_search_genre_multi" multiple="multiple">
                                            @forelse ($genres as $genre)
                                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                            @empty
                                                <option value="0">{{ trans('backend_artist.empty_genre') }}</option>
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
