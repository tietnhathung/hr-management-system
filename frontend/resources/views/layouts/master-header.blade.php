<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="/assets/themes/coreui/vendors/@@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
    </button>
    <a class="c-header-brand d-lg-none text-uppercase" href="#">
        <strong>Quản lý kho</strong>
    </a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="/assets/themes/coreui/vendors/@@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
    </button>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item d-md-down-none mx-2">{{ \Auth::user()->fullname }}</li>
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar"><img class="c-avatar-img" src="/assets/images/no-avatar.jpg" alt="Avatar"></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Thông tin tài khoản</strong></div>
                <a class="dropdown-item" href="{{ route('personal.edit') }}">
                    <div class="c-icon mr-2">
                        <i class="fas fa-user"></i>
                    </div>
                    Thông tin cá nhân
                </a>
                <a class="dropdown-item" href="{{ route('personal.changePasswordEdit') }}">
                    <div class="c-icon mr-2">
                        <i class="fas fa-key"></i>
                    </div>
                    Đổi mật khẩu
                </a>
                <a class="dropdown-item" href="{{ route('auth.logout') }}">
                    <div class="c-icon mr-2">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    Đăng xuất
                </a>
            </div>
        </li>
    </ul>
</header>