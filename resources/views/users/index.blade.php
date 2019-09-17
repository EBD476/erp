@extends('layouts.app')

@section('title', 'Users Management')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class="col-lg-12 ">
                <h3><i class="fa fa-user pull-right">&nbsp;{{__('User Administration')}}</i>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary pull-left"><i
                                class="tim-icons icon-simple-add"></i>{{__('Roles')}}</a>
                    <a href="{{ route('permissions.index') }}"
                       class="btn btn-primary pull-left"><i
                                class="tim-icons icon-simple-add"></i>{{__('Permissions')}}</a>
                    <a href="{{ route('users.create') }}" class="btn btn-primary"><i
                                class="tim-icons icon-simple-add"></i>{{__('Add User')}}</a>

                </h3>
                <hr>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" style="font-size: 13px;color: #65767c">
                                    <table class="table  table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Username')}}</th>
                                            <th>{{__('Code')}}</th>
                                            <th>{{__('Date/Time Created')}}</th>
                                            <th>{{__('User Roles')}}</th>
                                            <th>{{__('Operations')}}</th>
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
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                       class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                        <i class="tim-icons icon-pencil"></i></a>
                                                    <form id="-form-delete{{$user->id}}" style="display: none;"
                                                          method="POST" action="{{route('users.destroy', $user->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"
                                                       onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                               event.preventDefault();
                                                               document.getElementById('-form-delete{{$user->id}}').submit();
                                                               }else {
                                                               event.preventDefault();}"><i
                                                                class="tim-icons icon-simple-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <br><br>
                        <div class="card card-user">
                            <div class="card-body">
                                <p class="card-text">
                                    <div class="author">
                                        <div class="block block-one"></div>
                                        <div class="block block-two"></div>
                                        <div class="block block-three"></div>
                                        <div class="block block-four"></div>
                                        <a href="javascript:void(0)">
                                            {{--<img class="avatar" src="../assets/img/emilyz.jpg" alt="...">--}}
                                            <h5 class="title">Hanta IBMS</h5>
                                        </a>
                                <p class="description">
                                    {{--Available Products--}}
                                </p>
                            </div>
                            </p>
                            <div class="card-description">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection