@extends('layouts.app')

@section('title',__('Products Property Items'))

@push('script')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
@endpush


@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    @role('Admin')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('product-property-items.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i> &nbsp;
                        {{__('New Products Property Items')}}
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Products Property Items List')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-hover">
                                        <table id="table" class="table" cellspacing="0" width="100%">
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Items Name')}}
                                            </th>
                                            <th>
                                                {{__('Action')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($items as $key => $item)
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    <td>
                                                        {{$item ->hppi_items_name}}
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
                                                                   href="{{route('product-property-items.edit',$item->id)}}"
                                                                >{{__('Edit')}}</a>
                                                                <form id="-form-delete{{$item->id}}"
                                                                      style="display: none;" method="POST"
                                                                      action="{{route('product-property-items.destroy',$item->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a class="dropdown-item"
                                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                           event.preventDefault();
                                                                           document.getElementById('-form-delete{{$item->id}}').submit();
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
    @role('product')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('product-property-items.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i> &nbsp;
                        {{__('New Products Property Items')}}
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Products Property Items List')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-hover">
                                        <table id="table" class="table" cellspacing="0" width="100%">
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Items Name')}}
                                            </th>
                                            <th>
                                                {{__('Action')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($items as $key => $item)
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    <td>
                                                        {{$item ->hppi_items_name}}
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
                                                                   href="{{route('product-property-items.edit',$item->id)}}"
                                                                >{{__('Edit')}}</a>
                                                                <form id="-form-delete{{$item->id}}"
                                                                      style="display: none;" method="POST"
                                                                      action="{{route('product-property-items.destroy',$item->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a class="dropdown-item"
                                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                           event.preventDefault();
                                                                           document.getElementById('-form-delete{{$item->id}}').submit();
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