@extends('home.template')

@section('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        <!--Edit Profile Wrapper Start-->
        <div class="ms_profile_wrapper">
            <h1>{{ trans('home_member.edit_profile') }} - {{ $member->email }}</h1>
            <div class="ms_profile_box">
                <div class="ms_pro_img">
                    @if($member->avatar == '')
                        <img src="{{ asset(config('bower.home_images') . 'pro_img.jpg') }}" alt="" class="img-fluid">
                    @else
                        <img src="{{ asset(getThumbName($member->avatar, 250, 250)) }}" alt="" class="img-fluid">
                    @endif
                    <div class="pro_img_overlay">
                        <i class="fa_icon edit_icon"></i>
                    </div>
                </div>
                <div class="ms_pro_form">
                    <form action="{{ route('member.update', $member->id) }}" method="post" enctype="multipart/form-data" id="form_update_info">
                        @csrf
                        @method('put')
                        <div class="form-group {{ $errors->has('name') ? 'has-warning' : '' }}">
                            <label>{{ trans('home_member.your_name') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('name') }}</small>
                            <input type="text" name="name" value="{{ $member->name }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        </div>
                        <div class="form-group {{ $errors->has('avatar') ? 'has-warning' : '' }}">
                            <label>{{ trans('home_member.your_avatar') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('avatar') }}</small>
                            <input type="file" name="avatar" class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}">
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-warning' : '' }}">
                            <label>{{ trans('home_member.your_pass') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('password') }}</small>
                            <input type="password" name="password" placeholder="******" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('home_member.confirm_pass') }}</label>
                            <input type="password" name="password_confirmation" placeholder="******" class="form-control">
                        </div>
                        <div class="form-group {{ $errors->has('birthday') ? 'has-warning' : '' }}">
                            <label>{{ trans('home_member.birthday') }}</label>
                            <small class="form-text text-muted">{{ $errors->first('birthday') }}</small>
                            <input type="text" name="birthday" class="form-control {{ $errors->has('birthday') ? 'is-invalid' : '' }}" id="birthday">
                        </div>
                        <div class="pro-form-btn text-center marger_top15">
                            <a href="#" class="ms_btn" onclick="event.preventDefault(); document.getElementById('form_update_info').submit()">{{ trans('home_member.save') }}</a>
                            <a href="{{ route('home') }}" class="ms_btn">{{ trans('home_member.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset(config('bower.home_css') . 'jquery-ui-datepicker.css') }}">
@endsection

@section('script')
    <script src="{{ asset(config('bower.home_js') . 'jquery-ui-datepicker.js') }}"></script>
    <script src="{{ asset('js/frontend/birthday.js') }}"></script>
@endsection

