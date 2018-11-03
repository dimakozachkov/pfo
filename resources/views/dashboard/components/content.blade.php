<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
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
    </section>
    <!-- /.content -->
</div>