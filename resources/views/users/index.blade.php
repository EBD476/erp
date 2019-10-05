@extends('layouts.app')

@section('title', 'Users Management')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

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
                                    <table id="table" class="table  table-striped">
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
                            <div class="card-description">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#table').DataTable({
                        "language": {
                            "sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
                            "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                            "sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
                            "sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
                            "sInfoPostFix":    "",
                            "sInfoThousands":  ",",
                            "sLengthMenu":     "نمایش _MENU_ رکورد",
                            "sLoadingRecords": "در حال بارگزاری...",
                            "sProcessing":     "در حال پردازش...",
                            "sSearch":         "جستجو:",
                            "sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
                            "oPaginate": {
                                "sFirst":    "ابتدا",
                                "sLast":     "انتها",
                                "sNext":     "بعدی",
                                "sPrevious": "قبلی"
                            },
                            "oAria": {
                                "sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
                                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                            }
                        }
                    });
                });
            </script>
@endpush