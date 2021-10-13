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
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.users.index') }}">{{ trans('backend_user.index_title') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="card">
                            <div class="card-header">
                                {!! trans('backend_user.label_form_update') !!}
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('backend.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label class="form-control-label">{{ trans('backend_user.td_email') }}</label>
                                        <input type="email" class="form-control-success form-control" name="name" value="{{ $user->email }}" disabled="disabled">
                                    </div>
                                    @if(count($user->roles) > 0)
                                    <div class="form-group">
                                        <label>{{ trans('backend_user.old_role') }} :</label>
                                        <p>
                                            @forelse($user->roles as $role)
                                                <a href="javascript:void(0)" class="btn btn-outline-info">{{ $role->name }}</a>
                                            @empty
                                            @endforelse
                                        </p>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-control-label">{{ trans('backend_user.form_roles') }}</label>
                                        <small class="form-text text-muted">{{ $errors->first('roles.*') }}</small>
                                        <select name="roles[]" class="user_search_role_multi" multiple="multiple">
                                            @forelse ($roles as $role)
                                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                            @empty
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
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.user_search_role_multi').select2();
        })
    </script>
@endsection
