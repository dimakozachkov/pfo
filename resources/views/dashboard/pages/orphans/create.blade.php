@extends('dashboard.master')

@php
    $title = trans('dashboard/app.orphans.add');
    $selectMenu = 'orphans';
    $subSelectMenu = 'add';
@endphp

@push('breadcrums')
    <li><a href="{{ route('dashboard.orphans.index') }}"><i class="fa fa-address-book"></i> Orphans</a></li>
    <li class="active"><i class="fa fa-plus"></i> Add</li>
@endpush

@section('content')
    <form enctype="multipart/form-data" action="{{ route('dashboard.orphans.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="first_name">First name:</label>

                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control pull-left" id="first_name" name="first_name">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="last_name">Last name:</label>

                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control pull-right" id="last_name" name="last_name">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="latin_name">First name:</label>

                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control pull-left" id="latin_name" name="latin_name">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Birthday:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-left" id="datepicker" name="birthday">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="inputCountry">Select a country</label>
                <select class="form-control col-xs-12" id="inputCountry" name="country_id">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputResidence">Select a residence</label>
                <select class="form-control col-xs-12" id="inputResidence" name="residence_id">
                    @foreach($residences as $residence)
                        <option value="{{ $residence->id }}">{{ $residence->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row" style="margin-left: 0;">
            <div class="form-group col-xs-12" style="padding: 0;">
                <label for="about">About</label>
                <textarea class="form-control" rows="3" name="about" id="about"></textarea>
            </div>
        </div>
        <div class="row" style="margin-left: 0;">
            <div class="form-group col-xs-12" style="padding: 0;">
                <label for="contact">Contacts</label>
                <textarea class="form-control" rows="3" name="contact" id="contact"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="from-group col-xs-12">
                <label for="photo">Upload your file</label>
                <input type="file" name="photo" id="photo"/>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-xs-12">
                <input type="submit" class="btn btn-primary" value="Create"/>
            </div>
        </div>
    </form>
@endsection
