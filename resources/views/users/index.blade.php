@extends('layouts.app')

@section('title', 'Users Management')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">
    <div class="col-lg-12 ">
        <h3><i class="fa fa-user">&nbsp;</i>{{__('User Administration')}}
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h3>
        <hr>
        <div class="table-responsive" style="font-size: 13px;color: #65767c">
            <table class="table  table-striped">

                <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Code</th>
                    <th>Date/Time Created</th>
                    <th>User Roles</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($users as $user)
                    <tr>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->device_id }}</td>
                        <td>{{ $user->created_at->format('F d, Y') }}</td>
                        <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            <form action="{{route('users.destroy', $user->id)}}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-xs btn-danger" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>

        </h3>
        </div>
    </div>
@endsection