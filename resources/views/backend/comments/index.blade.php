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
                                    <span class="badge badge-pill badge-success">{{ trans('backend_comment.label_success') }}</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">{{ trans('backend_comment.label_error') }}</span>
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <table id="commentTable" class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="th-sm">#</th>
                                    <th class="th-sm">{{ trans('backend_comment.type') }}</th>
                                    <th class="th-sm">{{ trans('backend_comment.user') }}</th>
                                    <th class="th-sm">{{ trans('backend_comment.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($comments as $key => $comment)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            {!! $comment->track_id != '' ? 'Track - ' . $comment->track->name : '' !!}
                                            {!! $comment->album_id != '' ? 'Album - ' . $comment->album->title : '' !!}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#comment_name_{{ $comment->id }}">{!! $comment->status == 0 ? '<span class="alert alert-warning">' . $comment->user->email . '</span>' : $comment->user->email !!}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.comments.update', $comment->id) }}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('update_comment_{{ $comment->id }}').submit();"><i class="zmdi zmdi-upload"></i></a>
                                            <a href="{{ route('backend.comments.destroy', $comment->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                                    !window.confirm('{{ trans('backend_comment.alert_script', ['label' => $comment->track_id != '' ? 'Track - ' . $comment->track->name : '']) }}') ? false : document.getElementById('delete_comment_{{ $comment->id }}').submit();">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form action="{{ route('backend.comments.update', $comment->id) }}" method="post" id="update_comment_{{ $comment->id }}">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="status" value="1">
                                            </form>
                                            <form action="{{ route('backend.comments.destroy', $comment->id) }}" method="post" id="delete_comment_{{ $comment->id }}">
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
                                    <th class="th-sm">{{ trans('backend_comment.type') }}</th>
                                    <th class="th-sm">{{ trans('backend_comment.user') }}</th>
                                    <th class="th-sm">{{ trans('backend_comment.action') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @forelse ($comments as $comment)
        <div class="modal fade" id="comment_name_{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">{{ $comment->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p><b>{{ trans('backend_comment.user') }}</b>: {{ $comment->user->email }}</p>
                            <p><b>{{ trans('backend_comment.type') }}</b>:
                                {!! $comment->track_id != '' ? 'Track - ' . $comment->track->name : '' !!}
                                {!! $comment->album_id != '' ? 'Album - ' . $comment->album->title : '' !!}
                            </p>
                            <p><b>{{ trans('backend_comment.comment') }}</b>: {{ $comment->content }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('backend.comments.update', $comment->id) }}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('update_comment_{{ $comment->id }}').submit();"><i class="zmdi zmdi-upload"></i></a>
                        <a href="{{ route('backend.comments.destroy', $comment->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                !window.confirm('{{ trans('backend_comment.alert_script', ['label' => $comment->track_id != '' ? 'Track - ' . $comment->track->name : '']) }}') ? false : document.getElementById('delete_comment_{{ $comment->id }}').submit();">
                            <i class="zmdi zmdi-delete"></i>
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('backend_comment.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse
@endsection

@section ('style')
    <link rel="stylesheet" href="{{ asset(config('bower.css') . 'jquery.dataTables.min.css') }}">
@endsection

@section ('script')
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'backend_script.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#commentTable').DataTable();
        });
    </script>
@endsection
