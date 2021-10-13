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
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.genres.index') }}">{{ trans('backend_genre.label') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="card">
                            <div class="card-header">
                                {!! trans('backend_genre.label_form') !!}
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('backend.genres.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group {{ $errors->has('name') ? 'has-warning' : '' }}">
                                        <label class=" form-control-label">{{ trans('backend_genre.form_name') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('name') }}</small>
                                        <input type="text" class="form-control-success form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group {{ $errors->has('picture') ? 'has-warning' : '' }}">
                                        <label class=" form-control-label">{{ trans('backend_genre.form_picture') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('picture') }}</small>
                                        <input type="file" class="form-control-success form-control {{ $errors->has('picture') ? 'is-invalid' : '' }}" name="picture">
                                    </div>
                                    <div class="form-group {{ $errors->has('name') ? 'has-warning' : 'has-success' }}">
                                        <label class=" form-control-label">{{ trans('backend_genre.form_description') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('description') }}</small>
                                        <textarea name="description" id="genreEditor" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30" rows="10">{{ old('description') }}</textarea>
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
@endsection

@section ('script')
@endsection
