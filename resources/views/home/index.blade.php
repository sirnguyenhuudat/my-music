@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <!-- Banner -->
        @include('home.homepage.banner')
        <!-- Recently Played Music -->
        @if (isset($tracks_recently))
            @include('home.homepage.recently')
        @endif
        <!-- Weekly Top 15 -->
        @include('home.homepage.weekly_top_15')
        <!-- Featured Artists Music -->
        @include('home.homepage.featured_artists')
        <!-- New Releases Section Start -->
        @include('home.homepage.releases')
        <!-- Featured Albumn Section Start -->
        @include('home.homepage.featured_album')
        <!-- Top Genres Section Start -->
        @include('home.homepage.genres')
    </div>
    <!-- Audio Player Section -->
    @include('home.layouts.player')
    @include('home.layouts.extends');
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/index.css') }}">
@endsection
