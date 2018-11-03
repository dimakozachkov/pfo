@extends('dashboard.master')

@php
    $title = trans('dashboard/app.users.list');
    $selectMenu = 'layouts';
    $subSelectMenu = 'list';
@endphp

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-tools">
                <form action="{{ route('dashboard.templates.index') }}">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="search" class="form-control pull-right" placeholder="Search"
                               value="{{ request('search') }}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($templates as $template)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <a href="{{ route('dashboard.templates.edit', $template) }}">
                                    {{ $template->title }}
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('dashboard.templates.destroy', $template) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection