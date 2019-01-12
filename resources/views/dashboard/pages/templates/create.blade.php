@extends('dashboard.master')

@php
    $title = trans('dashboard/app.users.add');
    $selectMenu = 'layouts';
    $subSelectMenu = 'add';
@endphp

@push('breadcrums')
    <li><a href="{{ route('dashboard.templates.index') }}"><i class="fa fa-book"></i> Layouts</a></li>
    <li class="active"><i class="fa fa-plus"></i> Add</li>
@endpush

@section('content')
    <div class="box box-primary">
        <!-- form start -->
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('dashboard.templates.store') }}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputTitle" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title">
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="from-group">
                        <label for="photo" class="col-sm-3 control-label">Upload your file</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" id="photo"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection