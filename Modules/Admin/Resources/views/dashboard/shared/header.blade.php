<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
        <a class="c-header-brand d-sm-none" href="#">
            <img class="c-header-brand" src="{{ url('/assets/brand/coreui-base.svg') }}" width="97" height="46"
                 alt="CoreUI Logo">
        </a>

        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('icons/language_icon.png') }}" alt="switch lang icon" width="16" height="16">
                    @if(app()->getLocale() == 'en') English
                    @elseif(app()->getLocale() == 'vi') Tiếng việt
                    @else 日本
                    @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('switch.language', 'en') }}">English</a>
                    <a class="dropdown-item" href="{{ route('switch.language', 'vi') }}">Tiếng việt</a>
                    <a class="dropdown-item" href="{{ route('switch.language', 'jp') }}">日本</a>
                </div>
            </li>
            <li class="c-sidebar-nav-item dropdown">
                <span class="c-sidebar-nav-link">
                    <span class="text-capitalize">Admin</span>
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="c-avatar">
                            <a style="text-decoration: none" href="{{ route('admin::logout') }}"><i style="font-size: 27px; color: black;" class="cil-account-logout"></i></a>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0 pb-0 my-0">
                        <form action="{{ url('/logout') }}" method="POST">
                            @csrf
                            <div class="dropdown-item">
                                <svg class="c-icon">
                                    <use xlink:href="{{ url('/icons/sprites/free.svg#cil-account-logout') }}"></use>
                                </svg>
                                <button type="submit" class="btn btn-block">Logout</button>
                            </div>
                        </form>
                    </div>
                </span>
            </li>
        </ul>
