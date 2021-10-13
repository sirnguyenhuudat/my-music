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
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.albums.create') }}">
                                <i class="zmdi zmdi-plus"></i>{{ trans('backend_album.label_add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-40">
                            @if (session('success'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">{{ trans('backend_album.label_success') }}</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">{{ trans('backend_album.label_error') }}</span>
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <table id="albumTable" class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="th-sm">#</th>
                                    <th class="th-sm">{{ trans('backend_album.td_title') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_picture') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_relate_date') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_artist') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_genre') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_view') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($albums as $key => $album)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#album_name_{{ $album->id }}">{{ $album->title }}</a></td>
                                        @if ($album->picture != '')
                                            <td>
                                                <img src="{{ asset(getThumbName($album->picture)) }}" alt="picture" class="img-thumbnail">
                                            </td>
                                        @else
                                            <td>
                                                <img src="{{ asset(config('image.icon') . 'logo-mini.png') }}" alt="picture" class="img-thumbnail">
                                            </td>
                                        @endif
                                        <td>{{ $album->relate_date }}</td>
                                        <td>{{ $album->artist->name }}</td>
                                        <td>{{ $album->genre->name }}</td>
                                        <td>{{ $album->views }}</td>

                                        <td>
                                            <a href="javascript:void(0)" attr-id="{{ $album->id }}" class="btn {{ $album->featured ? 'btn-danger' : 'btn-info' }} add_featured"><i class="zmdi {{ $album->featured ? 'zmdi-eye-off' : 'zmdi-eye' }}"></i></a>
                                            <a href="{{ route('backend.albums.edit', $album->id) }}" class="btn btn-primary"><i class="zmdi zmdi-edit"></i></a>
                                            <a href="{{ route('backend.albums.destroy', $album->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                                    !window.confirm('{{ trans('backend_album.alert_script', ['title' => $album->title,]) }}') ? false : document.getElementById('delete_album_{{ $album->id }}').submit();">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form action="{{ route('backend.albums.destroy', $album->id) }}" method="post" id="delete_album_{{ $album->id }}">
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
                                    <th class="th-sm">{{ trans('backend_album.td_title') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_picture') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_relate_date') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_artist') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_genre') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_view') }}</th>
                                    <th class="th-sm">{{ trans('backend_album.td_action') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @forelse ($albums as $album)
        <div class="modal fade" id="album_name_{{ $album->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">{{ $album->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                @if ($album->picture)
                                    <img src="{{ asset(getThumbName($album->picture, 250, 250)) }}" alt="picture" class="img-thumbnail">
                                @else
                                    <img src="{{ asset(config('image.icon') . 'logo-mini.png') }}" alt="picture" class="img-thumbnail">
                                @endif
                            </div>
                            <div class="col-lg-7">
                                <p><b>{{ trans('backend_album.td_relate_date') }}</b>:
                                    @if($album->relate_date != '')
                                        {{ $album->relate_date }}
                                    @else
                                        {{ trans('backend_album.updating') }}
                                    @endif
                                </p>
                                <p><b>{{ trans('backend_album.td_genre') }}</b>: {{ $album->genre->name }}</p>
                                <p><b>{{ trans('backend_album.td_artist') }}</b>: {{ $album->artist->name }}</p>
                                <p><b>{{ trans('backend_album.view_week') }}</b>: {{ $album->week_view }}</p>
                                <p><b>{{ trans('backend_album.view_month') }}</b>: {{ $album->month_view }}</p>
                                <p><b>{{ trans('backend_album.views') }}</b>: {{ $album->views }}</p>
                                <p><b>{{ trans('backend_album.info') }}</b>: {!! str_replace('\\r\\n', '<br/>', $album->info) !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-1">
                            <b>{{ trans('backend_album.tracks_of_album') }}</b>:
                            @forelse($album->tracks as $track)
                                <br/>- {{ $track->name }}
                            @empty
                                <br/>- {{ trans('backend_album.updating') }}
                            @endforelse
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('backend_album.label_cancel') }}</button>
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
    <script>
        $(document).ready(function () {
            $('#albumTable').DataTable();
            $('.add_featured').on('click', function () {
                var album_id = $(this).attr('attr-id');
                $.ajax({
                    'type' : 'get',
                    'url' : '{{ url('backend/album/featured') }}/' + album_id,
                    'async' : true,
                    'success' : function (result) {
                        var tmpThis = $('a[attr-id=' + album_id + ']');
                        alert(result.success);
                        var tag_i = tmpThis.children();
                        if (result.featured) {
                            tmpThis.removeClass('btn-info');
                            tmpThis.addClass('btn-danger');
                            tag_i.removeClass('zmdi-eye');
                            tag_i.addClass('zmdi-eye-off');
                        } else {
                            tmpThis.removeClass('btn-danger');
                            tmpThis.addClass('btn-info');
                            tag_i.removeClass('zmdi-eye-off');
                            tag_i.addClass('zmdi-eye');
                        }
                    }
                })
            })
        })
    </script>
@endsection

