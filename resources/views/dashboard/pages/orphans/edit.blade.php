@extends('dashboard.master')

@php
    $title = trans('dashboard/app.orphans.add');
    $selectMenu = 'orphans';
    $subSelectMenu = 'add';
@endphp

@section('content')
    <form enctype="multipart/form-data" enctype="multipart/form-data" action="{{ route('dashboard.orphans.update', $orphan) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First name:</label>

                    <div class="input-group">
                        <input type="text" class="form-control pull-left" id="first_name" name="first_name"
                               value="{{ $orphan->first_name }}">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last name:</label>

                    <div class="input-group">
                        <input type="text" class="form-control pull-right" id="last_name" name="last_name"
                               value="{{ $orphan->last_name }}">
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
                        <input type="text" class="form-control pull-left" id="datepicker" name="birthday"
                               value="{{ $orphan->birthday->format('m/d/y') }}">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Class:</label>
                    <div class="input-group">
                        <input type="number" min="0" class="form-control pull-right" name="class"
                               value="{{ $orphan->class }}">
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
                        <option value="{{ $country->id }}"
                                @if($country->id === $orphan->country_id) selected @endif>{{ $country->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" style="margin-right: 0;">
                <label for="inputResidence">Select a residence</label>
                <select class="form-control" id="inputResidence" name="residence_id">
                    @foreach($residences as $residence)
                        <option value="{{ $residence->id }}"
                                @if($residence->id === $residence->country_id) selected @endif>{{ $residence->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="about">About</label>
                <textarea class="form-control" rows="3" name="about" id="about">{{ $orphan->about }}"</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <label for="photos[]">Upload your file</label>
            <input type="file" name="photos[]" id="photos" multiple>
            <input type="submit" value="Upload">
        </div>
    </form>
@endsection