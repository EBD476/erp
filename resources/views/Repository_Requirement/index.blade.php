@extends('layouts.app')

@section('title',__('Product Requirement'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
{{--    @can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('repository_requirement.create')}}" class="btn btn-primary float-left mb-lg-2"><i class="tim-icons icon-simple-add"></i>{{__('Add New Repository')}}</a>
                </div>
                <div class="col-md-9">
                <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Repository Requirement')}}</h4>
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
                                        {{__('Product Id')}}
                                    </th>
                                    <th>
                                        {{__('Product Count')}}
                                    </th>
                                    <th>
                                        {{__('Comment')}}
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

                                    @foreach($Repositories_Requirement as $key => $Repositories_Requirement)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$Repositories_Requirement -> Product_Id}}
                                            </td>
                                            <td>
                                                {{$Repositories_Requirement ->Product_Count}}
                                            </td>
                                            <td>
                                                {{$Repositories_Requirement -> Comment}}
                                            </td>
                                            <td>
                                                {{$Repositories_Requirement -> created_at}}
                                            </td>
                                            <td>
                                                {{$Repositories_Requirement -> updated_at}}
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
                                                           href="{{route('repository_requirement.edit',$Repositories_Requirement->id)}}"
                                                        >{{__('Edit')}}</a>
                                                        <form id="-form-delete{{$Repositories_Requirement->id}}"
                                                              style="display: none;" method="POST"
                                                              action="{{route('repository_requirement.destroy',$Repositories_Requirement->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a class="dropdown-item"
                                                           onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                   event.preventDefault();
                                                                   document.getElementById('-form-delete{{$Repositories_Requirement->id}}').submit();
                                                                   }else {
                                                                   event.preventDefault();}">{{__('Delete')}}</a>
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