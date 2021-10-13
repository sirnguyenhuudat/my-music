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
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.artists.create') }}">
                                <i class="zmdi zmdi-plus"></i>{{ trans('backend_artist.label_add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-40">
                            @if (session('success'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">{{ trans('backend_artist.label_success') }}</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">{{ trans('backend_artist.label_error') }}</span>
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <table id="artistTable" class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="th-sm">#</th>
                                    <th class="th-sm">{{ trans('backend_artist.td_name') }}</th>
                                    <th class="th-sm">{{ trans('backend_artist.td_avatar') }}</th>
                                    <th class="th-sm">{{ trans('backend_artist.td_action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($artists as $key => $artist)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#artist_name_{{ $artist->id }}">{{ $artist->name }}</a></td>
                                        @if ($artist->avatar != '')
                                            <td>
                                                <img src="{{ asset(getThumbName($artist->avatar)) }}" alt="picture" class="img-thumbnail">
                                            </td>
                                        @else 
                                            <td>
                                                <img src="{{ asset(getThumbName(config('image.icon') . 'artist.png')) }}" alt="picture" class="img-thumbnail">
                                            </td>
                                        @endif
                                        <td>
                                            <a href="javascript:void(0)" attr-id="{{ $artist->id }}" class="btn {{ $artist->featured ? 'btn-danger' : 'btn-info' }} add_featured"><i class="zmdi {{ $artist->featured ? 'zmdi-eye-off' : 'zmdi-eye' }}"></i></a>
                                            <a href="{{ route('backend.artists.edit', $artist->id) }}" class="btn btn-primary"><i class="zmdi zmdi-edit"></i></a>
                                            <a href="{{ route('backend.artists.destroy', $artist->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                                    !window.confirm('{{ trans('backend_artist.alert_script', ['name' => $artist->name,]) }}') ? false : document.getElementById('delete_artist_{{ $artist->id }}').submit();">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form action="{{ route('backend.artists.destroy', $artist->id) }}" method="post" id="delete_artist_{{ $artist->id }}">
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
                                    <th class="th-sm">{{ trans('backend_artist.td_name') }}</th>
                                    <th class="th-sm">{{ trans('backend_artist.td_avatar') }}</th>
                                    <th class="th-sm">{{ trans('backend_artist.td_action') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @forelse ($artists as $artist)
        <div class="modal fade" id="artist_name_{{ $artist->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">{{ $artist->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                @if ($artist->avatar)
                                    <img src="{{ asset(getThumbName($artist->avatar, 250, 250)) }}" alt="picture" class="img-thumbnail">
                                @else
                                    <img src="{{ asset(getThumbName(config('image.icon') . 'artist.png', 250, 250)) }}" alt="picture" class="img-thumbnail">
                                @endif
                            </div>
                            <div class="col-lg-7">
                                <p><b>{{ trans('backend_artist.year_active') }}</b>: {{ $artist->year_active }} ({{ trans('backend_artist.year') }})</p>
                                <p><b>{{ trans('backend_artist.form_genres') }}</b>:
                                    @forelse($artist->genres as $genre)
                                        &nbsp;{{ $genre->name }},
                                    @empty
                                        {{ trans('backend_artist.empty_genre') }}
                                    @endforelse
                                </p>
                                <p><b>{{ trans('backend_artist.form_info') }}</b>: {!! str_replace('\n', '<br/>', $artist->info) !!}</p>
                            </div>
                        </div>
                        <p><b>{{ trans('backend_artist.label_album_released') }}</b>:
                        @forelse($artist->albums as $album)
                            <br/><a href="#">{{ $album->title }}</a>
                        @empty
                            {{ trans('backend_artist.empty_album') }}
                        @endforelse
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('backend_artist.label_cancel') }}</button>
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
            $('#artistTable').DataTable();
            $('.add_featured').on('click', function () {
                var artist_id = $(this).attr('attr-id');
                $.ajax({
                    'type' : 'get',
                    'url' : '{{ url('backend/artist/featured') }}/' + artist_id,
                    'async' : true,
                    'success' : function (result) {
                        var tmpThis = $('a[attr-id=' + artist_id + ']');
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

