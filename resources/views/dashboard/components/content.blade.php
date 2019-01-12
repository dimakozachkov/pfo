<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" style="min-height: 960px;">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    @stack('breadcrums')
                </ol>
            </section>
            <br>
            <br>
            <section>
                <div class="col-md-10">
                    @include('dashboard.components.flash')
                    @yield('content')
                </div>
            </section>
        </div>
    </section>
    <!-- /.content -->
</div>