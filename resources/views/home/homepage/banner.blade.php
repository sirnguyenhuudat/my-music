        <div class="ms-banner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="ms_banner_img">
                            @if(!$album_top_month || $album_top_month->picture == '')
                                <img src="{{ asset(config('bower.home_images') . '/banner.png') }}" alt="" class="img-fluid">
                            @else
                                <img src="{{ asset(getThumbName($album_top_month->picture, 510, 530)) }}" alt="" class="img-fluid">
                            @endif
                        </div>
                        <div class="ms_banner_text">
                            <h1>{{ trans('home_index.banner_title') }}</h1>
                            @if ($album_top_month)
                                <h1 class="ms_color">{{ $album_top_month->title }} {{ trans('home_index.banner_slogan') }}</h1>
                                <p>
                                    @foreach($album_top_month->tracks as $key => $track)
                                        {{ $track->name }}{!! $key == count($album_top_month->tracks) - 1 ? '.' : ',' !!}&nbsp;
                                        @if($key == 5)
                                            <br/>
                                        @endif
                                    @endforeach
                                </p>
                                <div class="ms_banner_btn">
                                    <a href="{{ route('album.detail', ['id' => $album_top_month->id, 'url' => $album_top_month->slug . '.html',]) }}" class="ms_btn">{{ trans('home_index.listen_now') }}</a>
                                    <a href="#" class="ms_btn">{{ trans('home_index.add_to_queue') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
