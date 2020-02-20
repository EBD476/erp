@extends('layouts.app')

@section('title',__('Support'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--                    @can('browse-btn-user')--}}
                    <a href="{{route('support.show')}}" class="btn btn-primary float-left mb-lg-2"><i
                                class="tim-icons icon-simple-add"></i>{{__('All Support Request List')}}</a>
                </div>
                {{--@endcan--}}
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Support')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title ">{{__('Projects List')}}</h4>
                                            <p class="card-category"></p>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table1" class="table" cellspacing="0" width="100%">
                                                    <thead class=" text-primary">
                                                    <th>
                                                        {{__('ID')}}
                                                    </th>
                                                    <th>
                                                        {{__('Project Name')}}
                                                    </th>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($project as $key => $projects)
                                                        <tr>
                                                            <td>
                                                                {{$key + 1}}
                                                            </td>
                                                            <td>
                                                                {{$projects -> hp_project_name}}
                                                            </td>
                                                            <td>
                                                                {{$projects -> hp_project_type}}
                                                            </td>
                                                            <td>
                                                                {{$projects -> created_at}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title ">{{__('Support Request')}}</h4>
                                            <p class="card-category"></p>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table2" class="table" cellspacing="0" width="100%">
                                                    <thead class=" text-primary">
                                                    <th>
                                                        {{__('ID')}}
                                                    </th>
                                                    <th>
                                                        {{__('Project Name')}}
                                                    </th>
                                                    <th>
                                                        {{__('action')}}
                                                    </th>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($request as $key => $requests)
                                                        <tr>
                                                            <td>
                                                                {{$key + 1}}
                                                            </td>
                                                            @foreach($project as $projects_name)
                                                                @if($projects_name->id == $requests -> hs_project_id)
                                                                    <td>
                                                                        {{$projects_name->hp_project_name}}
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                            {{--<td>--}}
                                                            {{--{{$request -> hs_description}}--}}
                                                            {{--</td>--}}
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                            class="btn btn-link dropdown-toggle btn-icon"
                                                                            data-toggle="dropdown">
                                                                        <i class="tim-icons icon-settings-gear-63"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right"
                                                                         aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item"
                                                                           href="{{route('support.edit',$requests->id)}}"
                                                                        >{{__('Show')}}</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--@endcan--}}
        @endsection

        @push('scripts')
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#table').DataTable({
                        "language": {
                            "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                            "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                            "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                            "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ",",
                            "sLengthMenu": "نمایش _MENU_ رکورد",
                            "sLoadingRecords": "در حال بارگزاری...",
                            "sProcessing": "در حال پردازش...",
                            "sSearch": "جستجو:",
                            "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                            "oPaginate": {
                                "sFirst": "ابتدا",
                                "sLast": "انتها",
                                "sNext": "بعدی",
                                "sPrevious": "قبلی"
                            },
                            "oAria": {
                                "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                            }
                        }
                    });
                });
            </script>
    @endpush