@extends('layouts.app')

@section('title',__('Order'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
{{--    @can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--@can('browse-btn-user')--}}
                    <a href="{{route('order.create')}}" class="btn btn-primary">{{__('Add New Order')}}</a>
                    {{--@endcan--}}
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
                                        {{__('Owner User')}}
                                    </th>
                                    <th>
                                        {{__('Create At')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                    <th>
                                        {{__('Accept State')}}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($order as $key => $order)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$order->hp_project_name}}
                                            </td>
                                            <td>
                                                {{$order->hp_employer_name}}
                                            </td>
                                            <td>
                                                {{$order->hp_connector}}
                                            </td>
                                            <td>
                                                {{$order->hp_type_project}}
                                            </td>
                                            <td>
                                                {{$order->hp_owner_user}}
                                            </td>
                                            <td>
                                                {{$order->created_at}}
                                            </td>
                                            <td>
                                                {{--@can('browse-btn-user')--}}
                                               <a href="{{route('order.edit',$order->id)}}" ><i class="tim-icons icon-pencil"></i></a>
                                                <form id ="-form-delete{{$order->id}}" style="display: none;" method="POST" action="{{route('order.destroy',$order->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove" onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                    event.preventDefault();
                                                    document.getElementById('-form-delete{{$order->id}}').submit();
                                                }else {
                                                    event.preventDefault();}"><i class="tim-icons icon-simple-remove"></i></a>
                                                 {{--@endcan--}}
                                            </td>
                                            <td>
                                                <input type="checkbox"><input type="checkbox">
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
        {{--@endcan--}}
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
                } );
                });
            </script>
    @endpush