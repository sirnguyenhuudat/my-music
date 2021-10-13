@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <!-- Featured Artist Section Start -->
        @include('home.homepage.featured_artists')

        <!-- Top Artist Section -->
        <div class="ms_top_artist">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ms_heading">
                            <h1>{{ trans('home_artist.title_page') }}</h1>
                        </div>
                    </div>
                    @forelse($artists as $artist)
                    <div class="col-lg-2 col-md-6">
                        <div class="ms_rcnt_box marger_bottom30">
                            <div class="ms_rcnt_box_img">
                                @if($artist->avatar == '')
                                <img src="{{ asset(config('bower.home_images') . 'radio/img' . rand(1, 13) . '.jpg') }}" alt="" class="img-fluid">
                                @else
                                <img src="{{ getThumbName($artist->avatar, 250, 250) }}" alt="" class="img-fluid">
                                @endif
                            </div>
                            <div class="ms_rcnt_box_text">
                                <h3><a href="{{ route('artist.show', ['id' => $artist->id, 'url' => $artist->slug . '.html',]) }}">{{ $artist->name }}</a></h3>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('style')
@endsection

@section ('script')
@endsection
