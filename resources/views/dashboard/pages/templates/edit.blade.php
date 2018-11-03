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
        <form class="form-horizontal" method="post" action="{{ route('dashboard.templates.update', $template) }}">
            @csrf
            @method('PUT')
            <div class="box-body">
                <br>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputTitle" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" id="inputTitle" placeholder="Title"
                               value="{{ $template->title }}">
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