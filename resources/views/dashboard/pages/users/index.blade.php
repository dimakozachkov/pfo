@extends('dashboard.master')

@php
    $title = trans('dashboard/app.users.list');
    $selectMenu = 'users';
    $subSelectMenu = 'list';
@endphp

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-tools">
                <form action="{{ route('dashboard.users.index') }}">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th style="width: 40px">Role</th>
                    <th>Country</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <a href="{{ route('dashboard.users.edit', $user) }}">
                                {{ $user->login }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('dashboard.users.edit', $user) }}">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-red">{{ \App\Attributes\RoleAttributes::ROLES_TEXT[$user->role] }}</span>
                        </td>
                        <td>{{ $user->country ? $user->country->title : '' }}</td>
                        <td>
                            <form action="{{ route('dashboard.users.destroy', $user) }}" method="post">
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
            {{ $users->render() }}
        </div>
    </div>
@endsection