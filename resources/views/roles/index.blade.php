@extends('layouts.app')

@section('title', '| Roles')

@section('content')


    <div class="wrap main-content" data-scrollbar>
        <div class="content">

            <div class="col-lg-12">
                <h3><i class="fa fa-key"></i> Roles

                    <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
                    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h3>
                <hr>
                <div class="table-responsive" style="font-size: 13px;color: #65767c">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($roles as $role)
                            <tr>

                                <td>{{ $role->name }}</td>

                                <td>{{  $role->permissions()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                <td>
                                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}"
                                       class="btn btn-xs btn-info pull-left" style="margin-right: 3px;">Edit</a>

                                    <form action="{{route('roles.destroy', $role->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-xs btn-danger" value="DELETE">
                                    </form>
                                    {{--{!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}--}}
                                    {{--{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
                                    {{--{!! Form::close() !!}--}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

                <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>

            </div>
        </div>
    </div>

@endsection