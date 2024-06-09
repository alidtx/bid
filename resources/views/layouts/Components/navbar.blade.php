<div class="app-header header-shadow bg-warning header-text-light">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar" id="side-hamburger">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav active">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>



    <div class="app-header__content header-mobile-open">

        <div class="app-header-right">
            <div class="header-dots">


            </div>

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="p-0 btn">
                                    @php
                                    $randomImage = "https://avatars.dicebear.com/api/initials/".auth()->user()->name.".svg"
                                    @endphp
                                    <img width="42" class="rounded-circle"
                                        src="{{ $randomImage }}"
                                        alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right"
                                    x-placement="bottom-end"
                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(60px, 44px, 0px);">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-info">
                                            <div class="menu-header-image opacity-2"
                                                style="background-image: url('{{asset("/images/dashboard/city3.jpg")}}');">
                                            </div>
                                            <div class="menu-header-content text-left">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">


                                                            <img width="42" class="rounded-circle"
                                                                src="{{  $randomImage  }}"
                                                                alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading text-dark">
                                                                {{ Auth::user()->name }}
                                                            </div>
                                                            <div class="widget-subheading text-dark opacity-8">
                                                                {{ Auth::user()->getRoleNames()->first() }}
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right mr-2">
                                                            <button
                                                                class="btn-pill btn-shadow btn-shine btn btn-danger"
                                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                                Logout
                                                            </button>
                                                            <form id="logout-form"
                                                                action="{{ route('logout') }}" method="POST"
                                                                style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item">
                                        </li>
                                        <li class="nav-item-btn text-center nav-item">
                                            {{-- <a class="btn-wide btn btn-primary btn-sm"
                                                href="{{route('post.index')}}">
                                                Open Posts
                                            </a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading text-dark">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="widget-subheading text-dark">
                                {{ Auth::user()->getRoleNames()->first() }}
                            </div>
                        </div>
                        <div class="widget-content-right header-user-info ml-3">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
