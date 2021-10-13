@extends('home.template')

@section('title_page')
    {{ $title_page }}
@endsection

@section('content')
    <div class="ms_content_wrapper padder_top80">
        <!-- Header -->
        @include('home.homepage.header')
        {{--Info Account--}}
        <div class="ms_account_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ms_account_wrapper">
                            @if (session('success'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">{{ trans('backend_artist.label_success') }}</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <div class="ms_pro_img">
                                @if($member->avatar == '')
                                    <img src="{{ asset(config('bower.home_images') . 'pro_img.jpg') }}" alt="" class="img-fluid">
                                @else
                                    <img src="{{ asset(getThumbName($member->avatar, 250, 250)) }}" alt="" class="img-fluid">
                                @endif
                            </div>
                            <div class="ms_heading">
                                <h1>{{ trans('home_member.account_overview') }}</h1>
                            </div>
                            <div class="ms_acc_ovrview_list">
                                <ul>
                                    <li>{{ $member->name }}
                                        <span>- {{ trans('home_member.name') }} </span>
                                    </li>
                                    <li>{{ $member->email }}
                                        <span>- {{ trans('home_member.email') }}</span>
                                    </li>
                                    <li>{{ $member->birthday }}
                                        <span>- {{ trans('home_member.birthday') }}</span>
                                    </li>
                                    <li>{{ $member->created_at->diffforHumans() }}
                                        <span>- {{ trans('home_member.created_at') }}</span>
                                    </li>
                                    <li>{{ $member->updated_at->diffforHumans() }}
                                        <span>- {{ trans('home_member.updated_at') }}</span>
                                    </li>
                                    <li>{{ count($member->playlists) }}
                                        <span>- {{ trans('home_member.playlist') }}</span>
                                    </li>
                                    <li>{{ count($member->tracks) }}
                                        <span>- {{ trans('home_member.track_uploaded') }}</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
@endsection

@section('script')
@endsection

