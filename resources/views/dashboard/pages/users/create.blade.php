@extends('dashboard.master')

@php
    $title = trans('dashboard/app.users.add');
    $selectMenu = 'users';
    $subSelectMenu = 'add';
@endphp

@section('content')
    <div class="box box-primary">
        <!-- form start -->
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('dashboard.users.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <br>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputEmail" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputLogin" class="col-sm-3 control-label">Login</label>

                    <div class="col-sm-9">
                        <input type="text" name="login" class="form-control" id="inputLogin" placeholder="Login">
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputUsername" class="col-sm-3 control-label">Username</label>

                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="inputUsername" placeholder="Username">
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputPassword" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputConfirmPassword" class="col-sm-3 control-label">Confirm password</label>

                    <div class="col-sm-9">
                        <input type="password" name="password_confirmation" class="form-control" id="inputConfirmPassword"
                               placeholder="Confirm password">
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputCountry" class="col-sm-3 control-label">Select a country</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="inputCountry" name="country">
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" style="margin-right: 0;">
                    <label for="inputRole" class="col-sm-3 control-label">Select an user role</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="inputRole" name="role">
                            <option value="0">Root</option>
                            <option value="1" selected>User</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Create</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection