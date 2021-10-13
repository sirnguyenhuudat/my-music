@extends('home.template')

@section ('title_page')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        {{--  Form forgot password--}}
        <div class="row justify-content-center">
            <br/>
            <br/>
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <br/>
                <br/>
                <form method="POST" action="{{ route('password.email') }}" id="forgot_form">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="javascript:void(0)" class="ms-btn" onclick="event.preventDefault(); document.getElementById('forgot_form').submit()">
                                {{ __('Send Password Reset Link') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
