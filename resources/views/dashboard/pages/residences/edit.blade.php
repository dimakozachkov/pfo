@extends('dashboard.master')

@php
    $title = 'Edit';
    $selectMenu = 'residences';
    $subSelectMenu = 'list';
@endphp

@push('breadcrums')
    <li><a href="{{ route('dashboard.residences.index') }}"><i class="fa fa-home"></i> Residences</a></li>
    <li class="active"><i class="fa fa-edit"></i> Edit</li>
@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('dashboard.residences.update', $residence) }}">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="box-body">
                <br>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputTitle" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Name of residence" value="{{ $residence->title }}">
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputCountry" class="col-sm-3 control-label">Select a country</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="inputCountry" name="country">
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" @if($residence->country_id == $country->id) selected @endif>{{ $country->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Update</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection