@extends('dashboard.master')

@php
    $title = trans('dashboard/app.residences.list');
    $selectMenu = 'residences';
    $subSelectMenu = 'list';
@endphp

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-tools">
                <form action="{{ route('dashboard.residences.index') }}">
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
                    <th>Country</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($residences as $residence)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <a href="{{ route('dashboard.residences.edit', $residence) }}">
                                {{ $residence->title }}
                            </a>
                        </td>
                        <td>{{ $residence->country->title }}</td>
                        <td>
                            <form action="{{ route('dashboard.residences.destroy', $residence) }}" method="post">
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
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $residences->render() }}
        </div>
    </div>
@endsection