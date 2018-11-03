<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p>{{ auth()->user()->name ?? "User name" }}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ trans('dashboard/leftside.main_navigation') }}</li>
            <li class="@if ($selectMenu === 'orphans') active @endif treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>{{ trans('dashboard/leftside.orphans') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li @if ($selectMenu === 'orphans' && $subSelectMenu === 'list') class="active" @endif>
                        <a href="{{ route('dashboard.orphans.index') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.orphans.list') }}
                        </a>
                    </li>
                    <li @if ($selectMenu === 'orphans' && $subSelectMenu === 'add') class="active" @endif>
                        <a href="{{ route('dashboard.orphans.create') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.orphans.add') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="@if ($selectMenu === 'users') active @endif treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>{{ trans('dashboard/leftside.users') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li @if ($selectMenu === 'users' && $subSelectMenu === 'list') class="active" @endif>
                        <a href="{{ route('dashboard.users.index') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.users.list') }}
                        </a>
                    </li>
                    <li @if ($selectMenu === 'users' && $subSelectMenu === 'add') class="active" @endif>
                        <a href="{{ route('dashboard.users.create') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.users.create') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="@if ($selectMenu === 'countries') active @endif treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i> <span>{{ trans('dashboard/leftside.countries') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li @if ($selectMenu === 'countries' && $subSelectMenu === 'list') class="active" @endif>
                        <a href="{{ route('dashboard.countries.index') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.countries.list') }}
                        </a>
                    </li>
                    <li @if ($selectMenu === 'countries' && $subSelectMenu === 'add') class="active" @endif>
                        <a href="{{ route('dashboard.countries.create') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.countries.add') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="@if ($selectMenu === 'residences') active @endif treeview">
                <a href="#">
                    <i class="fa fa-home"></i> <span>{{ trans('dashboard/leftside.residences') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li @if ($selectMenu === 'residences' && $subSelectMenu === 'list') class="active" @endif>
                        <a href="{{ route('dashboard.residences.index') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.residences.list') }}
                        </a>
                    </li>
                    <li @if ($selectMenu === 'residences' && $subSelectMenu === 'add') class="active" @endif>
                        <a href="{{ route('dashboard.residences.create') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.residences.add') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="@if ($selectMenu === 'layouts') active @endif treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>{{ trans('dashboard/leftside.layouts') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li @if ($selectMenu === 'layouts' && $subSelectMenu === 'list') class="active" @endif>
                        <a href="{{ route('dashboard.templates.index') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.layouts.list') }}
                        </a>
                    </li>
                    <li @if ($selectMenu === 'layouts' && $subSelectMenu === 'add') class="active" @endif>
                        <a href="{{ route('dashboard.templates.create') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('dashboard/leftside.layouts.add') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>