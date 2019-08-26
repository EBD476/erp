@extends('layouts.app')

@section('title',__('Repository'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('repository.create')}}" class="btn btn-primary">{{__('Add New Repository')}}</a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Repository')}}</h4>
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
                                        {{__('Product Stock')}}
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

                                    @foreach($Repositories as $key => $Repositories)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$Repositories -> Product_Id}}
                                            </td>
                                            <td>
                                                {{$Repositories ->Product_Stock}}
                                            </td>
                                            <td>
                                                {{$Repositories -> Comment}}
                                            </td>
                                            <td>
                                                {{$Repositories -> created_at}}
                                            </td>
                                            <td>
                                                {{$Repositories -> updated_at}}
                                            </td>
                               <td>
                                               <a href="{{route('repository.edit',$Repositories->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                                                <form id ="-form-delete{{$Repositories->id}}" style="display: none;" method="POST" action="{{route('repository.destroy',$Repositories->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"  onclick="if(confirm('آیا از حذف این مخزن اطمینان دارید؟')){
                                                    event.preventDefault();
                                                    document.getElementById('-form-delete{{$Repositories->id}}').submit();
                                                }else {
                                                    event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
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
                            },

                        }
                    } );
                });
            </script>
    @endpush