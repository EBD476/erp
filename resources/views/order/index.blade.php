@extends('layouts.app')

@section('title',__('Order'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    @role('order')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--@can('browse-btn-user')--}}
                    <a href="{{route('order.create')}}" class="btn btn-primary float-left mb-lg-2"><i
                                class="tim-icons icon-simple-add"></i>{{__('Add New Order')}}</a>
                    {{--@endcan--}}
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Order')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table" class="table" cellspacing="0" width="100%">
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Project Name')}}
                                            </th>
                                            <th>
                                                {{__('Employer Name')}}
                                            </th>
                                            <th>
                                                {{__('Connector')}}
                                            </th>
                                            <th>
                                                {{__('Type Project')}}
                                            </th>
                                            <th>
                                                {{__('action')}}
                                            </th>
                                            <th>
                                                {{__('Accept State')}}
                                            </th>
                                            </thead>
                                            <tbody>
                                            @foreach($order as $key => $orders)
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_project_name}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_employer_name}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_connector}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_type_project}}
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                    class="btn btn-link dropdown-toggle btn-icon"
                                                                    data-toggle="dropdown">
                                                                <i class="tim-icons icon-settings-gear-63"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                 aria-labelledby="dropdownMenuLink">
                                                                {{--<a class="dropdown-item"--}}
                                                                {{--href="{{route('order.edit',$orders->id)}}"--}}
                                                                {{-->{{__('Edit')}}</a>--}}
                                                                <form id="-form-delete{{$orders->id}}"
                                                                      style="display: none;" method="POST"
                                                                      action="{{route('order.destroy',$orders->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a class="dropdown-item"
                                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                           event.preventDefault();
                                                                           document.getElementById('-form-delete{{$orders->id}}').submit();
                                                                           }else {
                                                                           event.preventDefault();}">{{__('Delete')}}</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            @foreach($progress as $progresses)
                                                                {{--<span class="progress-value">25%</span>--}}
                                                                @if($progresses->ho_process_id == 1 and $orders->id == $progresses->order_id )
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100" style="width: 25%;"></div>
                                                                @endif
                                                                @if($progresses->ho_process_id == 2 and $orders->id == $progresses->order_id)
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100" style="width: 50%;"></div>
                                                                @endif
                                                                @if($progresses->ho_process_id == 3 and $orders->id == $progresses->order_id)
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width: 75%;"></div>
                                                                @endif
                                                                @if($progresses->ho_process_id == 4 and $orders->id == $progresses->order_id )
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width:100%; direction: ltr"></div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        {{--<input type="checkbox"><input type="checkbox">--}}
                                                    </td>
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
        </div>
    </div>
    @endrole
    @role('Admin')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--@can('browse-btn-user')--}}
                    <a href="{{route('order.create')}}" class="btn btn-primary float-left mb-lg-2"><i
                                class="tim-icons icon-simple-add"></i>{{__('Add New Order')}}</a>
                    {{--@endcan--}}
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Order')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table" class="table" cellspacing="0" width="100%">
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Project Name')}}
                                            </th>
                                            <th>
                                                {{__('Employer Name')}}
                                            </th>
                                            <th>
                                                {{__('Connector')}}
                                            </th>
                                            <th>
                                                {{__('Type Project')}}
                                            </th>
                                            <th>
                                                {{__('action')}}
                                            </th>
                                            <th>
                                                {{__('Accept State')}}
                                            </th>
                                            </thead>
                                            <tbody>
                                            @foreach($order as $key => $orders)
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_project_name}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_employer_name}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_connector}}
                                                    </td>
                                                    <td>
                                                        {{$orders->hp_type_project}}
                                                    </td>
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
                                                                href="{{route('order.edit',$orders->id)}}"
                                                                >{{__('Edit')}}</a>
                                                                <form id="-form-delete{{$orders->id}}"
                                                                      style="display: none;" method="POST"
                                                                      action="{{route('order.destroy',$orders->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a class="dropdown-item"
                                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                           event.preventDefault();
                                                                           document.getElementById('-form-delete{{$orders->id}}').submit();
                                                                           }else {
                                                                           event.preventDefault();}">{{__('Delete')}}</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            @foreach($progress as $progresses)
                                                                {{--<span class="progress-value">25%</span>--}}
                                                                @if($progresses->ho_process_id == 1 and $orders->id == $progresses->order_id )
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width: 25%;"></div>
                                                                @endif
                                                                @if($progresses->ho_process_id == 2 and $orders->id == $progresses->order_id)
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width: 50%;"></div>
                                                                @endif
                                                                @if($progresses->ho_process_id == 3 and $orders->id == $progresses->order_id)
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width: 75%;"></div>
                                                                @endif
                                                                @if($progresses->ho_process_id == 4 and $orders->id == $progresses->order_id )
                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-valuenow="60" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width:100%; direction: ltr"></div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
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
        </div>
    </div>
    @endrole
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