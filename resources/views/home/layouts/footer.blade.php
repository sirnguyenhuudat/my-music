    <div class="ms_footer_wrapper">
        <div class="ms_footer_logo">
            <a href="index-2.html"><img src="{{ asset(config('bower.home_images') . '/open_logo.png') }}" alt=""></a>
        </div>
        <div class="ms_footer_inner">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_box">
                        <h1 class="footer_title">{{ trans('home_index.footer_title_1') }}</h1>
                        <p>{{ trans('home_index.footer_content_1') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_box footer_app">
                        <h1 class="footer_title">{{ trans('home_index.footer_title_2') }}</h1>
                        <p>{!! trans('home_index.footer_content_2') !!}</p>
                        <a href="#" class="foo_app_btn"><img src="{{ asset(config('bower.home_images') . '/google_play.jpg') }}" alt="" class="img-fluid"></a>
                        <a href="#" class="foo_app_btn"><img src="{{ asset(config('bower.home_images') . '/app_store.jpg') }}" alt="" class="img-fluid"></a>
                        <a href="#" class="foo_app_btn"><img src="{{ asset(config('bower.home_images') . '/windows.jpg') }}" alt="" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_box footer_subscribe">
                        <h1 class="footer_title">{{ trans('home_index.footer_title_3') }}</h1>
                        <p>{{ trans('home_index.footer_content_3') }}</p>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="{{ trans('home_index.enter_your_name') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="{{ trans('home_index.enter_your_email') }}">
                            </div>
                            <div class="form-group">
                                <a href="#" class="ms_btn">{{ trans('home_index.sign_me_up') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_box footer_contacts">
                        <h1 class="footer_title">{{ trans('home_index.footer_title_4') }}</h1>
                        <ul class="foo_con_info">
                            <li>
                                <div class="foo_con_icon">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/phone.svg') }}" alt="">
                                </div>
                                <div class="foo_con_data">
                                    <span class="con-title">{{ trans('home_index.call_us') }}</span>
                                    <span>{{ trans('home_index.phone_number') }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="foo_con_icon">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/message.svg') }}" alt="">
                                </div>
                                <div class="foo_con_data">
                                    <span class="con-title">{{ trans('home_index.email_us') }}</span>
                                    <span>{!! trans('home_index.email') !!}</span>
                                </div>
                            </li>
                            <li>
                                <div class="foo_con_icon">
                                    <img src="{{ asset(config('bower.home_images') . '/svg/add.svg') }}" alt="">
                                </div>
                                <div class="foo_con_data">
                                    <span class="con-title">{{ trans('home_index.walk_in') }}</span>
                                    <span>{{ trans('home_index.address') }}</span>
                                </div>
                            </li>
                        </ul>
                        <div class="foo_sharing">
                            <div class="share_title">{{ trans('home_index.follow_us') }}</div>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
