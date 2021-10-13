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
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-40">
                            @if (session('success'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">{{ trans('backend_user.label_success') }}</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">{{ trans('backend_user.label_error') }}</span>
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <table id="userTable" class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="th-sm">#</th>
                                    <th class="th-sm">{{ trans('backend_user.td_email') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.td_name') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.td_avatar') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.roles') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.td_action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#user_name_{{ $user->id }}">{{ $user->name }}</a></td>
                                        @if ($user->avatar != '')
                                            <td>
                                                <img src="{{ asset(getThumbName($user->avatar)) }}" alt="avatar" class="img-thumbnail">
                                            </td>
                                        @else
                                            <td>
                                                <img src="{{ asset(config('image.icon') . 'logo-mini.png') }}" alt="avatar" class="img-thumbnail">
                                            </td>
                                        @endif
                                        <td>
                                            @forelse($user->roles as $role)
                                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm">{{ ucfirst($role->name) }}</a>
                                            @empty
                                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm">{{ trans('backend_user.member') }}</a>
                                            @endforelse
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.users.edit', $user->id) }}" class="btn btn-primary"><i class="zmdi zmdi-code-setting"></i></a>
                                            <a href="{{ route('backend.users.destroy', $user->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                                    !window.confirm('{{ trans('backend_user.alert_script', ['name' => $user->name,]) }}') ? false : document.getElementById('delete_user_{{ $user->id }}').submit();">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form action="{{ route('backend.users.destroy', $user->id) }}" method="post" id="delete_user_{{ $user->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="th-sm">#</th>
                                    <th class="th-sm">{{ trans('backend_user.td_email') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.td_name') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.td_avatar') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.roles') }}</th>
                                    <th class="th-sm">{{ trans('backend_user.td_action') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('style')
    <link rel="stylesheet" href="{{ asset(config('bower.css') . 'jquery.dataTables.min.css') }}">
@endsection

@section ('script')
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable();
        })
    </script>
@endsection
