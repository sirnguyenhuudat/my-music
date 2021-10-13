@extends ('home.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <!-- track single -->
        <div class="ms_blog_single_wrapper">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="ms_blog_single">
                        <div class="blog_single_img">
                            @include('home.track.player-audio')
                        </div>
                        <div class="blog_single_content">
                            <h3 class="ms_blog_title">{{ $track->name }} - <i>{{ $track->artist->name }}</i></h3>
                            <div class="ms_post_meta">
                                <ul>
                                    <li>{{ $track->created_at }} / </li>
                                    <li>{{ count($track->comments) }} {{ trans('home_track.comments') }}  </li>
                                </ul>
                            </div>
                            <blockquote>{{ trans('home_track.lyric') }}</blockquote>
                            <p>
                                @php
                                    $lyric = str_replace("\r\n", "<br/>", $track->lyric);
                                 @endphp
                                {!! $lyric !!}
                            </p>
                        </div>
                        <!--Blog Comment Form-->
                        @if (Auth::user())
                        <div class="blog_comments_forms">
                            <h1>{{ trans('home_track.leave_a_comment') }}</h1>
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                                <br><br>
                            @endif
                            <form action="{{ route('comment.save', ['type' => 'track-' . $track->id, 'url' => $track->slug . '.html',]) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="comment_input_wrapper">
                                            <input name="name" value="{{ Auth::user()->name }}" type="text" class="cmnt_field" placeholder="{{ trans('home_track.your_name') }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="comment_input_wrapper">
                                            <input name="email" value="{{ Auth::user()->email }}" type="email" class="cmnt_field" placeholder="{{ trans('home_track.your_email') }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="comment_input_wrapper {{ $errors->has('comment') ? 'has-warning' : '' }}">
                                            <textarea id="comment" name="comment" class="cmnt_field {{ $errors->has('comment') ? 'is-invalid' : '' }}" placeholder="{{ trans('home_track.your_comment') }}">{{ old('comment') }}</textarea>
                                        </div>
                                        <small class="form-text text-muted">{{ $errors->first('comment') }}</small>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="comment-form-submit">
                                            <input name="submit" type="submit" id="comment-submit" class="submit ms_btn" value="{{ trans('home_track.post_comment') }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <!--Sidebar Start-->
                    <div class="ms_sidebar">
                        <div class="blog_comments">
                            @if(count($track->comments))
                                <h1>{{ trans('home_track.comments') }} ({{ count($track->comments) }})</h1>
                            @endif
                            @forelse($track->comments as $comm)
                                <ol>
                                    <li>
                                        <div class="ms_comment_section">
                                            <div class="comment_img">
                                                @if($comm->user->avatar != '')
                                                    <img src="{{ asset(getThumbName($comm->user->avatar)) }}" alt="">
                                                @else
                                                    <img src="{{ asset(config('bower.home_images') . 'logo.png') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="comment_info">
                                                <div class="comment_head">
                                                    <h3>{{ $comm->user->name }}</h3>
                                                    <p>{{ $comm->diffForHumans }}</p>
                                                    <div>{{ $comm->content }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/track.css') }}">
@endsection

@section ('script')
    <script src="{{ asset('js/frontend/track.js') }}"></script>
@endsection
