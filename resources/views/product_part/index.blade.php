@extends('layouts.app')

@section('title',__('Products'))

@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('product_part.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i>
                        {{__('New Product Part')}}
                    </a>
                    <a class="btn btn-primary float-left mb-lg-2" data-target="#modalRegisterForm" href="#"
                       data-toggle="modal">
                        {{__('Computing Product')}}
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Products Part List')}}</h4>
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
                                                {{__('Model')}}
                                            </th>
                                            <th>
                                                {{__('Product Name')}}
                                            </th>
                                            <th>
                                                {{__('Price')}}
                                            </th>
                                            <th>
                                                {{__('Action')}}
                                            </th>
                                            </thead>

                                            <tbody>
                                            @foreach($product_part as $product_part)
                                                <tr>
                                                    {{--<form id="form1" enctype="multipart/form-data">--}}
                                                    {{--<td>--}}
                                                    {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                    {{--<input class="form-check-input" type="checkbox"--}}
                                                    {{--value="0" id="checkbox">--}}
                                                    {{--<span class="form-check-sign">--}}
                                                    {{--<span class="check"></span>--}}
                                                    {{--</span>--}}
                                                    {{--</label>--}}
                                                    {{--</div>--}}
                                                    {{--</td>--}}
                                                    {{--</form>--}}
                                                    <td>
                                                        {{$product_part->id}}
                                                    </td>

                                                    @foreach($part as $parts)
                                                        @if($parts->id == $product_part ->hpp_part_id)
                                                            <td>
                                                                {{$parts ->hp_name}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    <td>
                                                        {{$product_part ->hp_part_model}}
                                                    </td>
                                                    @foreach($product as $products)
                                                        @if($products->id == $product_part ->hpp_product_id)
                                                            <td>
                                                                {{$products ->hp_product_name}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    <td>
                                                        {{$product_part -> hpp_part_count}}
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
                                                                   href="{{route('product_part.edit',$product_part->id)}}"
                                                                >{{__('Edit')}}</a>
                                                                <form id="-form-delete{{$product_part->id}}"
                                                                      style="display: none;" method="POST"
                                                                      action="{{route('product_part.destroy',$product_part->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a class="dropdown-item"
                                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                           event.preventDefault();
                                                                           document.getElementById('-form-delete{{$product_part->id}}').submit();
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

                {{--//Product Details Modal//--}}
                <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">{{__('View Product Details')}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" id="modal_form" enctype="multipart/form-data">
                                <div class="modal-body mx-3">
                                    <div class="md-form mb-5">
                                        {{--<i class="fas fa-user prefix grey-text"></i>--}}
                                        <table class="table" cellspacing="0" width="100%">
                                            <tbody>
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('Product Name')}}
                                            </th>
                                            <th>
                                                {{__('Count')}}
                                            </th>
                                            <th>
                                                {{__('Verify')}}
                                            </th>
                                            </thead>
                                            <tr>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-deep-orange">{{__('Send')}}</button>
                                    </div>
                                </div>
                            </form>
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

        // Modal Form
        $("#modal_form").submit(function (event) {
            var data = $("#modal_form").serialize();
            event.preventDefault();
            $.blockUI();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/repository_requirement',
                type: 'POST',
                data: data,
                dataType: 'json',
                async: false,
                success: function (data) {
                    setTimeout($.unblockUI);
                    $("#modalRegisterForm").find("input").val("");
                    $("#modalRegisterForm").modal('hide');
                },
                cache: false,
            });
        });
        // End Modal Form

    </script>
@endpush