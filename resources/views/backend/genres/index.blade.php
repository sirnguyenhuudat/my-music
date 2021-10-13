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
                            <a class="au-btn au-btn-icon au-btn--blue" href="{{ route('backend.genres.create') }}">
                                <i class="zmdi zmdi-plus"></i>{{ trans('backend_genre.label_add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-40">
                            @if (session('success'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">{{ trans('backend_genre.label_success') }}</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">{{ trans('backend_genre.label_error') }}</span>
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <table id="genreTable" class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th class="th-sm">#</th>
                                    <th class="th-sm">{{ trans('backend_genre.td_name') }}</th>
                                    <th class="th-sm">{{ trans('backend_genre.td_picture') }}</th>
                                    <th class="th-sm">{{ trans('backend_genre.td_action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($genres as $key => $genre)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#genre_name_{{ $genre->id }}">{{ $genre->name }}</a></td>
                                        @if ($genre->picture != '')
                                            <td>
                                                <img src="{{ asset(getThumbName($genre->picture)) }}" alt="picture" class="img-thumbnail">
                                            </td>
                                        @else 
                                            <td>
                                                <img src="{{ asset(getThumbName(config('image.icon') . 'genre.jpg')) }}" alt="picture" class="img-thumbnail">
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('backend.genres.edit', $genre->id) }}" class="btn btn-primary"><i class="zmdi zmdi-edit"></i></a>
                                            <a href="{{ route('backend.genres.destroy', $genre->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                                    !window.confirm('{{ trans('backend_genre.alert_script', ['name' => $genre->name,]) }}') ? false : document.getElementById('delete_genre_{{ $genre->id }}').submit();">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form action="{{ route('backend.genres.destroy', $genre->id) }}" method="post" id="delete_genre_{{ $genre->id }}">
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
                                    <th class="th-sm">{{ trans('backend_genre.td_name') }}</th>
                                    <th class="th-sm">{{ trans('backend_genre.td_picture') }}</th>
                                    <th class="th-sm">{{ trans('backend_genre.td_action') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @forelse ($genres as $genre)
        <div class="modal fade" id="genre_name_{{ $genre->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">{{ $genre->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                @if ($genre->picture)
                                    <img src="{{ asset(getThumbName($genre->picture, 250, 250)) }}" alt="picture" class="img-thumbnail">
                                @else
                                    <img src="{{ asset(getThumbName(config('image.icon') . 'genre.jpg', 250, 250)) }}" alt="picture" class="img-thumbnail">
                                @endif
                            </div>
                            <div class="col-lg-7">
                                {{ $genre->description }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('backend_genre.label_cancel') }}</button>
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
@endsection
