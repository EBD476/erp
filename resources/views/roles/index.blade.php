@extends('layouts.app')

@section('title', '| Roles')

@section('content')


    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <a href="{{ route('users.index') }}" class="btn btn-primary pull-left"><i
                        class="tim-icons icon-simple-add"></i>{{__('Users')}}</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-primary pull-left"><i
                        class="tim-icons icon-simple-add"></i>{{__('Permissions')}}</a>
            <a href="{{ URL::to('roles/create') }}" class="btn btn-primary pull-left"><i
                        class="tim-icons icon-simple-add"></i>{{__('Add Role')}}</a>
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-9">
                        <h3><i class="fa fa-key pull-right">{{__('Roles')}}</i></h3>
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" style="font-size: 13px;color: #65767c">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{__('Role')}}</th>
                                            <th>{{__('Permissions')}}</th>
                                            <th>{{__('Operation')}}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($roles as $role)
                                            <tr>

                                                <td>{{ $role->name }}</td>

                                                <td>{{  $role->permissions()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                                <td>
                                                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}"
                                                       class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                        <i class="tim-icons icon-pencil"></i></a>

                                                    <form action="{{route('roles.destroy', $role->id)}}" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"
                                                       onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                               event.preventDefault();
                                                               document.getElementById('-form-delete{{$role->id}}').submit();
                                                               }else {
                                                               event.preventDefault();}"><i
                                                                class="tim-icons icon-simple-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>

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
    </div>

@endsection