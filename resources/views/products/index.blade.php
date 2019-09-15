@extends('layouts.app')

@section('title',__('Products'))

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
                    <a href="{{route('products.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i> &nbsp;
                        {{__('New Product')}}
                    </a>
                </div>
                <div class="col-md-9">
                <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('Products List')}}</h4>
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
                                        {{__('Name')}}
                                    </th>
                                    <th>
                                        {{__('Model')}}
                                    </th>
                                    <th>
                                        {{__('Price')}}
                                    </th>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $key => $product)
                                        <tr>
                                            {{--<td>--}}
                                                {{--{{$key + 1}}--}}
                                            {{--</td>--}}
                                            <td>
                                                {{$product ->id}}
                                            </td>
                                            <td>
                                                {{$product ->hp_product_name}}
                                            </td>
                                            <td class="text-left">
                                                {{$product -> hp_product_model}}
                                            </td>
                                            <td class="text-left">
                                                {{$product -> hp_product_price}}
                                            </td>
                                            <td>
                                               <a href="{{route('products.edit',$product->id)}}" class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                   <i class="tim-icons icon-pencil"></i></a>

                                                <form id ="-form-delete{{$product->id}}" style="display: none;" method="POST" action="{{route('products.destroy',$product->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"  onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                    event.preventDefault();
                                                    document.getElementById('-form-delete{{$product->id}}').submit();
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
                                Available Products
                            </p>
                        </div>
                        </p>
                        <div class="card-description">

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
                $(document).ready(function() {


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

                } );



            </script>
    @endpush