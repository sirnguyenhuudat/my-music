        <div class="ms_header">
            <div class="ms_top_left">
                <div class="ms_top_search">
                    <form method="post" id="form_search">
                        @csrf
                        <input type="text" class="form-control" id="search-input" placeholder="{{ trans('home_index.search_music_here') }}" autocomplete="off">
                    </form>
                </div>
                @if(count($tracksTrending) > 0)
                    <div class="ms_top_trend">
                        <span>
                            <a href="#"  class="ms_color">{{ trans('home_index.trending_title') }}</a>
                        </span>
                        <span class="top_marquee">
                            @forelse($tracksTrending as $key => $track)
                                @if($key < 3)
                                    <a href="{{ route('track.index', ['id' => $track->id, 'url' => $track->slug . '.html',]) }}">{{ $track->name }}</a>,
                                @else
                                    <a href="{{ route('trending') }}">(+{{ count($tracksTrending) - 3 }} {{ trans('home_index.trending_more') }})</a>
                                    @break
                                @endif
                            @empty
                            @endforelse
                        </span>
                    </div>
                @endif
            </div>
            <div class="ms_top_right">
                <div class="ms_top_lang">
                    <span data-toggle="modal" data-target="#lang_modal">{{ trans('home_index.langs') }} <img src="{{ asset(config('bower.home_images') . '/svg/lang.svg') }}" alt=""></span>
                </div>
                <div class="ms_top_btn">
                    @guest
                        <a href="javascript:void(0)" class="ms_btn login_btn" data-toggle="modal" data-target="#modalLogin"><span>{{ trans('home_index.login') }}</span></a>
                        @if (Route::has('register'))
                            <a href="javascript:void(0)" class="ms_btn reg_btn" data-toggle="modal" data-target="#modalRegister"><span>{{ trans('home_index.register') }}</span></a>
                        @endif
                    @else
                        <a href="javascript:void(0)" class="ms_admin_name">
                            {{ Auth::user()->name }}
                            @role('admin')
                                <span class="ms_pro_name">A</span>
                            @endrole
                            @role('member')
                                <span class="ms_pro_name">M</span>
                            @endrole
                        </a>
                        <ul class="pro_dropdown_menu">
                            @role('admin')
                                <li>
                                    <a href="{{ route('backend.users.index') }}">{{ trans('home_index.admin_page') }}</a>
                                </li>
                            @endrole
                            <li>
                                <a href="{{ route('member.profile', [
                                    'id' => Auth::user()->id,
                                    'url' => str_slug(Auth::user()->name) . '.html',
                                ]) }}">
                                    {{ trans('home_member.profile') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('member.setting', [
                                    'id' => Auth::user()->id,
                                    'url' => str_slug(Auth::user()->name) . '.html',
                                ]) }}">
                                    {{ trans('home_member.setting') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
