@extends('dashboard.master')

@php
    $title = trans('dashboard/app.countries.add');
    $selectMenu = 'countries';
    $subSelectMenu = 'add';
@endphp

@push('breadcrums')
    <li><a href="{{ route('dashboard.countries.index') }}"><i class="fa fa-pie-chart"></i> Countries</a></li>
    <li class="active"><i class="fa fa-plus"></i> Add</li>
@endpush

@section('content')
    <div class="box box-primary">
        <!-- form start -->
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('dashboard.countries.store') }}">
            @csrf
            <div class="box-body">
                <br>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputEmail" class="col-sm-3 control-label">Country code</label>

                    <div class="col-sm-9">
                        <input type="text" name="code" class="form-control" id="code" placeholder="Country code">
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="title" class="col-sm-3 control-label">Country title</label>

                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Country title">
                    </div>
                </div>

                <div class="form-group" style="margin-right: 0;">
                    <label for="icon" class="col-sm-3 control-label">An icon</label>

                    <div class="col-sm-9">
                        <input type="file" name="photo" id="icon"/>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Create</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection