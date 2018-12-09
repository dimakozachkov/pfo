@extends('dashboard.master')

@php
    $title = trans('dashboard/app.orphans.add');
    $selectMenu = 'orphans';
    $subSelectMenu = 'add';
@endphp

@section('content')
    <form enctype="multipart/form-data" action="{{ route('dashboard.orphans.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First name:</label>

                    <div class="input-group">
                        <input type="text" class="form-control pull-left" id="first_name" name="first_name">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last name:</label>

                    <div class="input-group">
                        <input type="text" class="form-control pull-right" id="last_name" name="last_name">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="col-md-12">
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
        <div class="col-md-12">
            <div class="form-group" style="margin-right: 0;">
                <label for="inputCountry">Select a country</label>
                <select class="form-control" id="inputCountry" name="country_id">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="about">About</label>
                <textarea class="form-control" rows="3" name="about" id="about"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="contact">Contacts</label>
                <textarea class="form-control" rows="3" name="contact" id="contact"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="from-group">
                <label for="photo">Upload your file</label>
                <input type="file" name="photo" id="photo"/>
            </div>
        </div>
        <div class="col-md-12">
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create"/>
            </div>
        </div>
    </form>
@endsection
