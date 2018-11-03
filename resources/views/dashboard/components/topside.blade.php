<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard.index') }}" class="logo">
        @php
            $appName = explode(' ', config('app.name'));
            $appNameAcronym = config('app.name_acronym');
        @endphp
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{{ $appNameAcronym{0} }}</b>{{ $appNameAcronym{1} }}{{ $appNameAcronym{2} }}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ $appName[0] }}</b> {{ $appName[1] }} {{ $appName[2] }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('logout') }}" title="{{ trans('dashboard/topside.logout') }}">
                        <i class="fa fa-sign-out"></i> {{ trans('dashboard/topside.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>