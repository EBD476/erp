@extends('layouts.app')

@section('title',__('Client'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
{{--    @can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
{{--                    @can('browse-btn-user')--}}
                    <a href="{{route('client.create')}}" class="btn btn-primary float-left mb-lg-2"><i class="tim-icons icon-simple-add"></i>{{__('Create new client')}}</a>
                    {{--@endcan--}}
                </div>
                <div class="col-md-9">
                <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Client')}}</h4>
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
                                        {{__('User ID')}}
                                    </th>
                                    <th>
                                        {{__('Create At')}}
                                    </th>
                                    <th>
                                        {{__('Update At')}}
                                    </th>
                                    <th>
                                        {{__('action')}}
                                    </th>
                                    </thead>
                                    <tbody>

                                    @foreach($client as $key => $client)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$client -> hc_user_id}}
                                            </td>
                                            <td>
                                                {{$client -> created_at}}
                                            </td>
                                            <td>
                                                {{$client -> updated_at}}
                                            </td>
                                            <td>
{{--                                                @can('browse-btn-user')--}}
                                               <a href="{{route('client.edit',$client->id)}}" class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                   <i class="tim-icons icon-pencil"></i></a>
                                                <form id ="-form-delete{{$client->id}}" style="display: none;" method="POST" action="{{route('client.destroy',$client->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"  onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                        event.preventDefault();
                                                        document.getElementById('-form-delete{{$client->id}}').submit();
                                                        }else {
                                                        event.preventDefault();}"><i class="tim-icons icon-simple-remove"></i></a>
                                                 {{--@endcan--}}
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
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right">{{__('Projects Locations')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div id="map" style="width: 100%; height: 400px;direction: ltr"></div>
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