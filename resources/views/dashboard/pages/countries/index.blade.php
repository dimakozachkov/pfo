@extends('dashboard.master')

@php
    $title = trans('dashboard/app.countries.list');
    $selectMenu = 'countries';
    $subSelectMenu = 'list';
@endphp

@push('breadcrums')
    <li class="active"><i class="fa fa-pie-chart"></i> Countries</li>
@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-tools">
                <form action="{{ route('dashboard.countries.index') }}">
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
                    <th style="width: 60px">#</th>
                    <th style="width: 100px">Code</th>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><span class="badge bg-red" style="color: white">{{ $country->code }}</span></td>
                        <td><a href="{{ route('dashboard.countries.edit', $country) }}">{{ $country->title }}</a></td>
                        <td><a href="{{ route('dashboard.countries.edit', $country) }}">{{ $country->title }}</a></td>
                        <td>
                            <form action="{{ route('dashboard.countries.destroy', $country) }}" method="post"
                                  class="pull-right">
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
            {{ $countries->render() }}
        </div>
    </div>
@endsection