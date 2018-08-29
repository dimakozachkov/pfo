@extends('dashboard.master')

@php
    $title = trans('dashboard/app.users.add');
    $selectMenu = 'layouts';
    $subSelectMenu = 'add';
@endphp

@section('content')
    <div class="box box-primary">
        <!-- form start -->
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('dashboard.templates.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <br>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputTitle" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <label for="photo">Upload your file</label>
                        <input type="file" name="photo" id="photo"/>
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