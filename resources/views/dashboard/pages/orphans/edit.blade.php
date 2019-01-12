@extends('dashboard.master')

@php
    $title = trans('dashboard/app.orphans.add');
    $selectMenu = 'orphans';
    $subSelectMenu = 'add';
@endphp

@push('breadcrums')
    <li><a href="{{ route('dashboard.orphans.index') }}"><i class="fa fa-address-book"></i> Orphans</a></li>
    <li class="active"><i class="fa fa-edit"></i> Edit</li>
@endpush

@section('content')
    <form enctype="multipart/form-data" enctype="multipart/form-data"
          action="{{ route('dashboard.orphans.update', $orphan) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="first_name">First name:</label>

                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               value="{{ $orphan->first_name }}">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="last_name">Last name:</label>

                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               value="{{ $orphan->last_name }}">
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
                        <input type="text" class="form-control pull-left" id="latin_name" name="latin_name" value="{{ $orphan->latin_name }}">
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
                        <input type="text" class="form-control pull-left" id="datepicker" name="birthday"
                               value="{{ $orphan->birthday ? $orphan->birthday->format('d/m/Y') : '' }}">
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
                        <option value="{{ $country->id }}"
                                @if($country->id === $orphan->country_id) selected @endif>{{ $country->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputResidence">Select a residence</label>
                <select class="form-control col-xs-12" id="inputResidence" name="residence_id">
                    @foreach($residences as $residence)
                        <option value="{{ $residence->id }}"
                                @if($residence->id === $residence->country_id) selected @endif>{{ $residence->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row" style="margin-left: 0;">
            <div class="form-group col-xs-12" style="padding: 0;">
                <label for="about">About</label>
                <textarea class="form-control" rows="3" name="about" id="about">{{ $orphan->about }}</textarea>
            </div>
        </div>
        <div class="row" style="margin-left: 0;">
            <div class="form-group col-xs-12" style="padding: 0;">
                <label for="contact">Contacts</label>
                <textarea class="form-control" rows="3" name="contact" id="contact">{{ $orphan->contact }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12">
                <label for="photos[]">Upload your file</label>
                <input type="file" name="photos[]" id="photos" multiple>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection