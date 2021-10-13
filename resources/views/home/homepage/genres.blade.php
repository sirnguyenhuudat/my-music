<div class="ms_genres_wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="ms_heading">
                <h1>{{ trans('home_index.top_genres') }}</h1>
                @if (is_array($top_genres) && count($top_genres) > config('conf.ConditionShowMoreItemInPage'))
                <span class="veiw_all"><a href="#">{{ trans('home_index.view_more') }}</a></span>
                @endif
            </div>
        </div>
        @if (is_array($top_genres) && count($top_genres) > 0)
            <div class="col-lg-4">
                <div class="ms_genres_box">
                    <img src="{{ asset(config('bower.home_images') . '/genrs/img1.jpg') }}" alt="" class="img-fluid" />
                    <div class="ms_main_overlay">
                        <div class="ovrly_text_div">
                            <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[0]->id, 'url' => $top_genres[0]->slug . '.html',]) }}">{{ $top_genres[0]->name }}</a></span>
                            <span class="ovrly_text2"><a href="javascript:void(0)">{{ trans('home_index.view_song') }}</a></span>
                        </div>
                    </div>
                    <div class="ms_box_overlay_on">
                        <div class="ovrly_text_div">
                            <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[0]->id, 'url' => $top_genres[0]->slug . '.html',]) }}">{{ $top_genres[0]->name }}</a></span>
                            <span class="ovrly_text2"><a href="javascript:void(0)">{{ trans('home_index.view_song') }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ms_genres_box">
                            <img src="{{ asset(config('bower.home_images') . '/genrs/img2.jpg') }}" alt="" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[1]->id, 'url' => $top_genres[1]->slug . '.html',]) }}">{{ $top_genres[1]->name }}</a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[1]->id, 'url' => $top_genres[1]->slug . '.html',]) }}">{{ $top_genres[1]->name }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ms_genres_box">
                            <img src="{{ asset(config('bower.home_images') . '/genrs/img3.jpg') }}" alt="" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[2]->id, 'url' => $top_genres[2]->slug . '.html',]) }}">{{ $top_genres[2]->name }}</a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[2]->id, 'url' => $top_genres[2]->slug . '.html',]) }}">{{ $top_genres[2]->name }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ms_genres_box">
                            <img src="{{ asset(config('bower.home_images') . '/genrs/img5.jpg') }}" alt="" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[3]->id, 'url' => $top_genres[3]->slug . '.html',]) }}">{{ $top_genres[3]->name }}</a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[3]->id, 'url' => $top_genres[3]->slug . '.html',]) }}">{{ $top_genres[3]->name }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ms_genres_box">
                            <img src="{{ asset(config('bower.home_images') . '/genrs/img6.jpg') }}" alt="" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[4]->id, 'url' => $top_genres[4]->slug . '.html',]) }}">{{ $top_genres[4]->name }}</a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[4]->id, 'url' => $top_genres[4]->slug . '.html',]) }}">{{ $top_genres[4]->name }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ms_genres_box">
                    <img src="{{ asset(config('bower.home_images') . '/genrs/img4.jpg') }}" alt="" class="img-fluid" />
                    <div class="ms_main_overlay">
                        <div class="ovrly_text_div">
                            <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[5]->id, 'url' => $top_genres[5]->slug . '.html',]) }}">{{ $top_genres[5]->name }}</a></span>
                        </div>
                    </div>
                    <div class="ms_box_overlay_on">
                        <div class="ovrly_text_div">
                            <span class="ovrly_text1"><a href="{{ route('genre.detail', ['id' => $top_genres[5]->id, 'url' => $top_genres[5]->slug . '.html',]) }}">{{ $top_genres[5]->name }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
