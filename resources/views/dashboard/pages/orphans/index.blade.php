@extends('dashboard.master')

@php
    $title = trans('dashboard/app.orphans.list');
    $selectMenu = 'orphans';
    $subSelectMenu = 'list';
@endphp

@push('breadcrums')
    <li class="active"><i class="fa fa-address-book"></i> Orphans</li>
@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-tools">
                <form action="{{ route('dashboard.orphans.index') }}">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="search" class="form-control pull-right"
                               placeholder="{{ trans('dashboard/app.search') }}"
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
                    <th>{{ trans('dashboard/orphan.full_name') }}</th>
                    <th>{{ trans('dashboard/orphan.birthday') }}</th>
                    <th>{{ trans('dashboard/orphan.old_years') }}</th>
                    <th>{{ trans('dashboard/orphan.сountry_code') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orphans as $orphan)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <a href="{{ route('dashboard.orphans.edit', $orphan) }}">{{ $orphan->first_name }} {{ $orphan->last_name }}</a>
                        </td>
                        <td>{{ $orphan->birthday ? $orphan->birthday->format('d/m/Y') : '' }}</td>
                        <td><span class="badge bg-olive" style="color: white">{{ $orphan->oldYears }}</span></td>
                        <td><span class="badge bg-red">{{ $orphan->country->code }}</span></td>
                        <td>
                            <form action="{{ route('dashboard.orphans.destroy', $orphan) }}" method="post"
                                  class="pull-right">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="btn btn-danger btn-xs">{{ trans('dashboard/app.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $orphans->render() }}
        </div>
    </div>
@endsection