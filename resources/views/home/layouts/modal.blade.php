<!-- Modal -->
<div class="ms_register_popup">
    <!-- Register Modal-->
    <div id="modalRegister" class="modal centered-modal" role="dialog">
        <div class="modal-dialog register_dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa_icon form_close"></i>
                </button>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}" id="resigter_form">
                        @csrf
                        <div class="ms_register_img">
                            <img src="{{ asset(config('bower.home_images') . '/register_img.png') }}" alt="" class="img-fluid"/>
                        </div>
                        <div class="ms_register_form">
                            <h2>{{ trans('home_index.register_signup') }}</h2>
                            <div class="form-group">
                                <input id="name_register" type="text" placeholder="{{ trans('home_index.enter_your_name') }}" class="form-control @error('name_reg') is-invalid @enderror" name="name_reg" value="{{ old('name_reg') }}" required autocomplete="name" autofocus>
                                <span class="form_icon">
                                    <i class="fa_icon form-user" aria-hidden="true"></i>
                                </span>
                                @error('name_reg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="email_register" type="email" placeholder="{{ trans('home_index.enter_your_email') }}" class="form-control @error('email_reg') is-invalid @enderror" name="email_reg" value="{{ old('email_reg') }}" required autocomplete="email">
                                <span class="form_icon">
                                    <i class="fa_icon form-envelope" aria-hidden="true"></i>
                                </span>
                                @error('email_reg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password_register" type="password" placeholder="{{ trans('home_index.enter_password') }}" class="form-control @error('password_reg') is-invalid @enderror" name="password_reg" required autocomplete="new-password">
                                <span class="form_icon">
                                    <i class="fa_icon form-lock" aria-hidden="true"></i>
                                </span>
                                @error('password_reg')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password_confrim" type="password" placeholder="{{ trans('home_index.confirm_password') }}" class="form-control" name="password_reg_confirmation" required autocomplete="new-password">
                                <span class="form_icon">
                                    <i class=" fa_icon form-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <a href="javascript:void(0)" class="ms_btn" onclick="event.preventDefault(); document.getElementById('resigter_form').submit()">{{ trans('home_index.register_now') }}</a>
                            <p>
                                {{ trans('home_index.already_account') }}<a href="#modalLogin" data-toggle="modal" class="ms_modal hideCurrentModel">{{ trans('home_index.login_here') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal-->
    <div id="modalLogin" class="modal centered-modal" role="dialog">
        <div class="modal-dialog login_dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa_icon form_close"></i>
                </button>
                <div class="modal-body">
                    <div class="ms_register_img">
                        <img src="{{ asset(config('bower.home_images') . '/register_img.png') }}" alt="" class="img-fluid"/>
                    </div>
                    <div class="ms_register_form">
                        <form method="post" action="{{ route('login') }}" id="form_login">
                            @csrf
                            <h2>{{ trans('home_index.login_signin') }}</h2>
                            <div class="form-group">
                                <input id="email_login" type="email" class="au-input au-input--full form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ trans('home_index.enter_your_email') }}">
                                <span class="form_icon">
                                    <i class="fa_icon form-envelope" aria-hidden="true"></i>
                                </span>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password_login" type="password" class="au-input au-input--full form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ trans('home_index.enter_password') }}">
                                <span class="form_icon">
                                    <i class="fa_icon form-lock" aria-hidden="true"></i>
                                </span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="remember_checkbox">
                                <label>{{ trans('home_index.keep_me_signed_in') }}
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-group row mb-0">
                                <a href="javascript:void(0)" class="ms_btn" onclick="event.preventDefault(); document.getElementById('form_login').submit()">
                                    {{ trans('home_index.login_now') }}
                                </a>
                                <div class="popup_forgot">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ trans('home_index.forgot_password') }}
                                    </a>
                                </div>
                            </div>
                            <p>
                                {{ trans('home_index.dont_have_account') }}<a href="#modalRegister" data-toggle="modal" class="ms_modal1 hideCurrentModel">{{ trans('home_index.register_here') }}</a>
                            </p>
                        </form>
                        <br>
                        <a href="{{ route('social.redirect', 'facebook') }}" class="login_with_social"><i class="fa fa-facebook-square"></i> {{ trans('home_index.login_fb') }}</a><br/>
                        <a href="{{ route('social.redirect', 'google') }}" class="login_with_social"><i class="fa fa-google"></i> {{ trans('home_index.login_gg') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Language Selection Modal -->
<div class="ms_lang_popup">
    <div id="lang_modal" class="modal centered-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa_icon form_close"></i>
                </button>
                <div class="modal-body">
                    <h1>{{ trans('home_index.language_selection') }}</h1>
                    <p>{{ trans('home_index.content_select_lang') }}</p>
                    <ul class="lang_list">
                        <form action="{{ route('home.change-language') }}" method="post" id="website-lang">
                            @csrf
                            <li>
                                <label class="lang_check_label">
                                    {{ trans('home_index.english') }}
                                    <input type="radio" name="language" value="en" {{ config('app.locale') == 'en' ? 'checked' : '' }}>
                                    <span class="label-text"></span>
                                </label>
                            </li>
                            <li>
                                <label class="lang_check_label">
                                    {{ trans('home_index.vietnamese') }}
                                    <input type="radio" name="language" value="vi" {{ config('app.locale') == 'vi' ? 'checked' : '' }}>
                                    <span class="label-text"></span>
                                </label>
                            </li>
                        </form>
                    </ul>
                    <div class="ms_lang_btn">
                        <a href="javascript:void(0)" class="ms_btn" onclick="document.getElementById('website-lang').submit()">{{ trans('home_index.apply') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Queue Clear Model -->
<div class="ms_clear_modal">
    <div id="clear_modal" class="modal centered-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa_icon form_close"></i>
                </button>
                <div class="modal-body">
                    <h1>{{ trans('home_index.clear_content') }}</h1>
                    <div class="clr_modal_btn">
                        <a href="javascript:void(0)" onclick="document.getElementById('destroy_queue').submit();">{{ trans('home_index.clear_all') }}</a>

                        <a href="javascript:void(0)">{{ trans('home_index.cancel') }}</a>
                    </div>
                </div>
                <form action="{{ route('queue.destroy') }}" method="post" id="destroy_queue">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>

