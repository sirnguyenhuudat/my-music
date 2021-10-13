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
                            <div>
                                <a class="au-btn au-btn-icon au-btn--blue show-table" attr-table="role" href="javascript:void(0)">
                                    <i class="zmdi zmdi-eye"></i>{{ trans('backend_access.show_role_table') }}
                                </a>
                                <a class="au-btn au-btn-icon au-btn--green hidden-table" attr-table="role" href="javascript:void(0)">
                                    <i class="zmdi zmdi-eye-off"></i>{{ trans('backend_access.hidden_role_table') }}
                                </a>
                                <a class="au-btn au-btn-icon au-btn--blue show-table" attr-table="permission" href="javascript:void(0)">
                                    <i class="zmdi zmdi-eye"></i>{{ trans('backend_access.show_permission_table') }}
                                </a>
                                <a class="au-btn au-btn-icon au-btn--green hidden-table" attr-table="permission" href="javascript:void(0)">
                                    <i class="zmdi zmdi-eye-off"></i>{{ trans('backend_access.hidden_permission_table') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-40">
                            @if (session('success'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">{{ trans('backend_role.label_success') }}</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">{{ trans('backend_role.label_error') }}</span>
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            {{-- Role Table--}}
                            <div id="role">
                                <a class="au-btn au-btn-icon au-btn--blue" href="javascript:void(0)" data-toggle="modal" data-target="#add_permission_to_role">
                                    <i class="zmdi zmdi-plus"></i>{{ trans('backend_access.add_permission_to_role') }}
                                </a>
                                <table id="roleTable" class="table table-borderless table-striped table-earning">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">#</th>
                                        <th class="th-sm">{{ trans('backend_access.role') }}</th>
                                        <th class="th-sm">{{ trans('backend_access.permissions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @forelse($role->permissions as $permission)
                                                        <a href="javascript:void(0)" class="btn btn-outline-info">{{ $permission->name }}</a>
                                                    @empty
                                                        {{ trans('backend_access.empty') }}
                                                    @endforelse
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">{{ trans('backend_access.empty') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="th-sm">#</th>
                                        <th class="th-sm">{{ trans('backend_access.role') }}</th>
                                        <th class="th-sm">{{ trans('backend_access.permissions') }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                             {{-- Permission Table --}}
                            <div id="permission">
                                <a class="au-btn au-btn-icon au-btn--blue" href="javascript:void(0)" data-toggle="modal" data-target="#add_role_to_permission">
                                    <i class="zmdi zmdi-plus"></i>{{ trans('backend_access.add_role_to_permission') }}
                                </a>
                                <table id="permissionTable" class="table table-borderless table-striped table-earning">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">#</th>
                                        <th class="th-sm">{{ trans('backend_access.permission') }}</th>
                                        <th class="th-sm">{{ trans('backend_access.roles') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($permissions as $key => $permission)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                @forelse($permission->roles as $role)
                                                    <a href="javascript:void(0)" class="btn btn-outline-info">{{ $role->name }}</a>
                                                @empty
                                                    {{ trans('backend_access.empty') }}
                                                @endforelse
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">{{ trans('backend_access.empty') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="th-sm">#</th>
                                        <th class="th-sm">{{ trans('backend_access.permission') }}</th>
                                        <th class="th-sm">{{ trans('backend_access.roles') }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  Modal add Permission to Role--}}
    <div class="modal fade" id="add_permission_to_role" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="mediumModalLabel">{!! trans('backend_access.add_permission_to_role') !!}</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('backend.access.add.permissions') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('role') ? 'has-warning' : '' }}">
                            <label class=" form-control-label">{{ trans('backend_access.role') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('role') }}</small>
                            <select name="role" class="form-control-success form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" id="create_form_role_role">
                                @forelse($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('permissions.*') ? 'has-warning' : '' }}">
                            <label class=" form-control-label">{{ trans('backend_access.permissions') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('permissions.*') }}</small>
                            <select name="permissions[]" class="role_search_permission_multi form-control {{ $errors->has('permissions.*') ? 'is-invalid' : '' }}" id="create_form_role_permissions" multiple>
                                @forelse($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="create_submit" name="submit" class="btn btn-primary">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('backend_role.label_cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--  Modal add Roles to Permission --}}
    <div class="modal fade" id="add_role_to_permission" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="mediumModalLabel">{!! trans('backend_access.add_role_to_permission') !!}</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('backend.access.add.roles') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('permission') ? 'has-warning' : '' }}">
                            <label class=" form-control-label">{{ trans('backend_access.permission') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('permission') }}</small>
                            <select name="permission" class="form-control-success form-control {{ $errors->has('permission') ? 'is-invalid' : '' }}">
                                @forelse($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('roles.*') ? 'has-warning' : '' }}">
                            <label class=" form-control-label">{{ trans('backend_access.roles') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('roles.*') }}</small>
                            <select name="roles[]" class="permission_search_roles_multi form-control {{ $errors->has('roles.*') ? 'is-invalid' : '' }}" multiple>
                                @forelse($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="create_submit" name="submit" class="btn btn-primary">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('backend_role.label_cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset(config('bower.css') . 'select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/access.css') }}">
@endsection

@section('script')
    @error('role')
        <script type="text/javascript" src="{{ asset('js/backend/access_role.js') }}"></script>
    @enderror
    @error('permissions.*')
        <script type="text/javascript" src="{{ asset('js/backend/access_role.js') }}"></script>
    @enderror
    @error('permission')
        <script type="text/javascript" src="{{ asset('js/backend/access_permission.js') }}"></script>
    @enderror
    @error('roles.*')
        <script type="text/javascript" src="{{ asset('js/backend/access_permission.js') }}"></script>
    @enderror
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/backend/access.js') }}"></script>
@endsection
