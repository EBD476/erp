@extends('layouts.app')

@section('title',__('Repository'))

@push('script')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
@endpush


@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('repository_create.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i> &nbsp;
                        {{__('New Repository')}}
                    </a>
                </div>
                <div class="col-md-12">
                    <a href="{{route('provider.index')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i> &nbsp;
                        {{__('Provider')}}
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Repository List')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-hover">
                                        <table id="table" class="table" cellspacing="0" width="100%">
                                            <thead class=" text-primary">
                                            {{--<th>--}}
                                                {{--{{__('Statuses')}}--}}
                                            {{--</th>--}}
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Name')}}
                                            </th>
                                            <th>
                                                {{__('Description')}}
                                            </th>
                                            <th>
                                                {{__('Action')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($repository as $key => $repository)
                                                <tr>
                                                    <td>
                                                        {{$repository ->id}}
                                                    </td>
                                                    <td>
                                                        {{$repository ->hr_name}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$repository -> hr_description}}
                                                    </td>
                                                    <td>
                                                        <a href="{{route('repository_create.edit',$repository->id)}}"
                                                           class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                            <i class="tim-icons icon-pencil"></i></a>

                                                        <form id="-form-delete{{$repository->id}}" style="display: none;"
                                                              method="POST"
                                                              action="{{route('repository_create.destroy',$repository->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"
                                                           onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                   event.preventDefault();
                                                                   document.getElementById('-form-delete{{$repository->id}}').submit();
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
                                        {{__('Available Products')}}
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
        {{--@endcan--}}
        @endsection

        @push('scripts')

            <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
            <script>
                $(document).ready(function () {
                    $('#table').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "عبارت جستجو",
                            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                        }

                    });

                });

                $("#checkbox").on('change', function (event) {
                    if ($("#checkbox").val() == 1) {

                    }
                    else {
                        $("#checkbox").val() == 1
                    }
                });


            </script>
    @endpush