@extends('layouts.app')

@section('title',__('Request'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('request.create')}}" class="btn btn-primary float-left mb-lg-2"><i class="tim-icons icon-simple-add"></i>{{__('Add New Request')}}</a>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Request')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('Row')}}
                                    </th>
                                    <th>
                                        {{__('Product')}}
                                    </th>
                                    <th>
                                        {{__('Product Count')}}
                                    </th>
                                    <th>
                                        {{__('User ID')}}
                                    </th>
                                    <th>
                                        {{__('Request Date')}}
                                    </th>
                                    <th>
                                        {{__('Accept Level')}}
                                    </th>
                                    <th>
                                        {{__('action')}}
                                    </th>
                                    </thead>
                                    <tbody>

                                    @foreach($Request as $key => $Request)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$Request -> goods}}
                                            </td>
                                            <td>
                                                {{$Request -> goods_count}}
                                            </td>
                                            <td>
                                                {{$Request->user_id}}
                                            </td>
                                            <td>
                                                {{$Request -> request_date}}
                                            </td>
                                            <td>
                                                {{$Request -> accept_level}}
                                            </td>
                                            <td>
                                               <a href="{{route('request.edit',$Request->id)}}" class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                   <i class="tim-icons icon-pencil"></i></a>
                                                <form id ="-form-delete{{$Request->id}}" style="display: none;" method="POST" action="{{route('request.destroy',$Request->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"  onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                        event.preventDefault();
                                                        document.getElementById('-form-delete{{$Request->id}}').submit();
                                                        }else {
                                                        event.preventDefault();}"><i class="tim-icons icon-simple-remove"></i></a>
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