@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <!-- Featured Albumn Section Start -->
        @include('home.homepage.featured_album')
        <!-- Trending Album -->
        @include('home.albums.trending_album')
        <!-- Top 15 Album -->
        @include('home.albums.top15_albums')
        <!-- Newly Released Albums -->
        @include('home.albums.released_albums')
    </div>
@endsection

@section ('style')
@endsection

@section ('script')
@endsection
