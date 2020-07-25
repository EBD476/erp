@extends('layouts.app')

@section('title', __('Permissions'))

@section('content')
    @role('Admin')
    <div class="wrap main-content persian" data-scrollbar>
        <div class="content">
            <div class="col-md-12">
                <h3>
                    <a href="{{ route('users.index') }}" class="btn btn-primary pull-left"><i
                                class="tim-icons icon-simple-add"></i>{{__('Users')}}</a>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary pull-left"><i
                                class="tim-icons icon-simple-add"></i>{{__('Roles')}}</a>
                    <a href="{{ URL::to('permissions/create') }}"
                       class="btn btn-primary pull-left"><i
                                class="tim-icons icon-simple-add"></i>{{__('Add Permission')}}</a>
                </h3>
            </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="col-lg-12 ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Available Permissions')}}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="font-size: 13px;color: #65767c">
                                    <table class="table table-striped">

                                        <thead>
                                        <tr>
                                            <th>{{__('Permissions')}}</th>
                                            <th>{{__('Operation')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}"
                                                       class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                        <i class="tim-icons icon-pencil"></i></a>

                                                    <form action="{{route('permissions.destroy', $permission->id)}}"
                                                          style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"
                                                       onclick="if(confirm('آیا از حذف این مجوز اطمینان دارید؟')){
                                                               event.preventDefault();
                                                               document.getElementById('-form-delete{{$permission->id}}').submit();
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

                                </p>
                            </div>
                            </p>
                            <div class="card-description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endrole
@endsection