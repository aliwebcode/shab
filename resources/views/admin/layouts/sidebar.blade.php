<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @yield('index')">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span>
                </a>
            </li>

            <li class="nav-item @yield('mail')">
                <a href="{{ route('admin.mail.index') }}">
                    <i class="la la-envelope"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> البريد</span>
                </a>
            </li>

            <li class="nav-item has-sub @yield('profile')">
                <a href="#">
                    <i class="la la-cogs"></i>
                    <span class="menu-title" data-i18n="Form Wizard">إعدادات الموقع</span>
                </a>
                <ul class="menu-content" style="">
                    <li class="">
                        <a class="menu-item" href="#">
                            <i class="la la-cog"></i><span data-i18n="Circle Style">المعلومات الأساسية</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="#">
                            <i class="la la-phone"></i><span data-i18n="Notification Style">معلومات التواصل</span>
                        </a>
                    </li>
                    <li class="@yield('profile')">
                        <a class="menu-item" href="{{ route('admin.profile') }}">
                            <i class="la la-user"></i><span data-i18n="Notification Style">ملفي الشخصي</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.logout') }}">
                    <i class="la la-power-off"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">تسجيل الخروج</span>
                </a>
            </li>

        </ul>
    </div>
</div>
