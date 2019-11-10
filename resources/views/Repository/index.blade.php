@extends('layouts.app')

@section('title',__('Repository'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    @role('verifier')

    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <a href="{{route('repository.create')}}"
                   class="btn btn-primary">{{__('Add New Repository')}}</a>
                <div class="row">
                    {{--Repository Data List--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Repository')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table1" cellspacing="0" width="100%">
                                        <thead class=" text-primary">
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Product Name')}}
                                        </th>
                                        <th>
                                            {{__('Product Stock')}}
                                        </th>
                                        <th>
                                            {{__('Comment')}}
                                        </th>
                                        </thead>
                                        <tbody>

                                        @foreach($Repositories as $key => $Repositories_show)
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                @foreach($product as $products)
                                                    @if($products->id == $Repositories_show ->hr_product_id)
                                                        <td>
                                                            {{$products->hp_product_name}}
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    {{$Repositories_show ->hr_product_stock}}
                                                </td>
                                                <td>
                                                    {{$Repositories_show ->hr_comment}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--End Repository Data List--}}

                    {{--Order Data List--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Order List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table1" cellspacing="0" width="100%">
                                        <thead class=" text-primary">
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Order ID')}}
                                        </th>
                                        <th>
                                            {{__('Client Name')}}
                                        </th>
                                        <th>
                                            {{__('Product Name')}}
                                        </th>
                                        <th>
                                            {{__('Count')}}
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $key => $orders_show )
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    {{$orders_show -> hpo_order_id}}
                                                </td>
                                                @foreach($client as $clients)
                                                    @if($clients->hc_user_id == $orders_show ->hpo_client_id)
                                                        <td>
                                                            {{$clients->hc_name}}
                                                        </td>
                                                    @endif
                                                @endforeach

                                                @foreach($product as $products)
                                                    @if($products->id == $orders_show ->hpo_product_id)
                                                        <td>
                                                            {{$products->hp_product_name}}
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    {{$orders_show ->hpo_count}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--End Order Data List--}}

                </div>

                {{--Requirement Product List--}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-tasks">

                            {{--Drop Done Show Details Product List--}}
                            <div class="card-header ">
                                <h6 class="title d-inline">{{__('Inventory Deficit')}}</h6>
                                <p class="card-category d-inline">@foreach($order_all as $orders_all){{$orders_all->sum_hpo - $repository_product_count}}@endforeach</p>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                            data-toggle="dropdown">
                                        <i class="tim-icons icon-settings-gear-63"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"
                                         aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                           data-target="#modalRegisterForm">{{__('Details')}}</a>
                                        {{--<a class="dropdown-item" href="#pablo">Another action</a>--}}
                                        {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                                    </div>
                                </div>
                            </div>
                            {{--End Dropd Show Details Product List--}}

                            <div class="card-body ">
                                <div class="table-full-width table-responsive ps ps--active-y">
                                    <form id="form1">
                                    <table class="table">
                                        <tbody>
                                        <thead>
                                        <th><p class="title">{{__('Order ID')}}:</p></th>
                                        <th><p class="title">{{__('Product Name')}}:</p></th>
                                        <th><p class="title">{{__('Inventory')}}:</p></th>
                                        <th><p class="title">{{__('Status Verify')}}:</p></th>
                                        </thead>
                                        @foreach($orders as $item)
                                            @if($item->hpo_status != "Approved")
                                                @foreach($product as $goods)
                                                    @foreach($Repositories as $repository_selected)
                                                        <tr>
                                                            @if($repository_selected->hr_product_id == $goods->id)
                                                                @if($item->hpo_product_id == $repository_selected->hr_product_id)
                                                                    @foreach($product as $p)
                                                                        @if($p->id == $repository_selected->hr_product_id )


                                                                            <td>
                                                                                <p class="text-muted">{{$item->hpo_order_id}}</p>
                                                                            </td>


                                                                            <td>
                                                                                <p class="text-muted">{{$p->hp_product_name}}</p>
                                                                            </td>

                                                                            <td>
                                                                                <p class="text-muted">{{$repository_selected ->hr_product_stock - $item->hpo_count}}</p>
                                                                                <input hidden
                                                                                       value="{{$repository_selected ->hr_product_stock - $item->hpo_count}}"
                                                                                       class="computing_repository"
                                                                                       data.computing="{{$repository_selected ->hr_product_stock - $item->hpo_count}}">

                                                                            </td>
                                                                            {{--<td class="td-actions text-right">--}}
                                                                            {{--<button type="button" rel="tooltip" title=""--}}
                                                                            {{--class="btn btn-link"--}}
                                                                            {{--data-original-title="Edit Task">--}}
                                                                            {{--<i class="tim-icons icon-pencil"></i>--}}
                                                                            {{--</button>--}}
                                                                            {{--</td>--}}

                                                                            <td>
                                                                                <div class="form-check ">
                                                                                    <label class="form-check-label">
                                                                                        <input class="form-check-input checkbox"
                                                                                               type="checkbox"
                                                                                               data-id="{{$item->hpo_order_id}}">
                                                                                        <span class="form-check-sign">
                                                                <span class="check"></span>
                                                                </span>
                                                                                    </label>
                                                                                </div>
                                                                                <input id="product" type="hidden" value="{{$item->hpo_product_id}}">
                                                                            </td>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                        @endif

                                                        @endforeach

                                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <div class="modal-footer d-flex left">
                                            <input id="button" type="submit"
                                                    class="btn btn-deep-orange" value="{{__('Verify')}}">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--//Product Details Data//--}}
                    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold">{{__('View Details Data')}}</h4>
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
                                                    {{__('Inventory Deficit')}}
                                                </th>
                                                </thead>
                                                @foreach($query as $item)
                                                    @foreach($product as $products)
                                                        @if($item->hpo_product_id == $products->id)
                                                            <tr>
                                                                <td>
                                                                    {{$products->hp_product_name}}
                                                                </td>
                                                                <td>
                                                                    {{$item->sum_hpo}}
                                                                </td>
                                                                @foreach($Repositories as $repository_stock)
                                                                    <td>
                                                                        {{$item->sum_hpo - $repository_stock->hr_product_stock}}
                                                                    </td>
                                                                @endforeach
                                                                @endif
                                                                @endforeach
                                                                @endforeach

                                                            </tr>
                                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="submit"
                                                    class="btn btn-deep-orange">{{__('Request Send')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                {{--End Requirement Product List--}}
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
                    <h4 class="modal-title w-100 font-weight-bold">{{__('View Details Data')}}</h4>
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
                                    {{__('Inventory Deficit')}}
                                </th>
                                </thead>
                                @foreach($query as $item)
                                    @foreach($product as $products)
                                        @if($item->hpo_product_id == $products->id)
                                            <tr>
                                                <td>
                                                    {{$products->hp_product_name}}
                                                </td>
                                                <td>
                                                    {{$item->sum_hpo}}
                                                </td>
                                                @foreach($Repositories as $repository_stock)
                                                    <td>
                                                        {{$item->sum_hpo - $repository_stock->hr_product_stock}}
                                                    </td>
                                                @endforeach
                                                @endif
                                                @endforeach
                                                @endforeach

                                            </tr>
                                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit"
                                    class="btn btn-deep-orange">{{__('Request Send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--//End Product Details modal//--}}
    @endrole


@endsection
@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#button").prop('disabled',true);

            // Data Table
            $('#table1').DataTable({
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
                    },

                }
            });
            // End Data Table

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

            // var dataArray = new Array();
            // pass checkbox data
            $('.checkbox').on('change', function (event) {
                $("#button").prop('disabled', false);
                if (event.target.checked) {
                    var product = $('#product').val();
                    var data = {
                        id: $(this).data('id'),
                        state: $(this)[0].checked == true ? 3 : 2,
                        product:product,
                        // computing: $(this).data('computing'),

                    };
                    {{--$.blockUI({ message:'{{__('please wait...')}}', css: {--}}
                            {{--border: 'none',--}}
                            {{--padding: '15px',--}}
                            {{--backgroundColor: '#000',--}}
                            {{--'-webkit-border-radius': '10px',--}}
                            {{--'-moz-border-radius': '10px',--}}
                            {{--opacity: .5,--}}
                            {{--color: '#fff'}--}}
                        {{--});--}}
                    //token
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/order-state/'+data.id,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                            // alert(data.response);
                            // setTimeout($.unblockUI, 2000);
                        },
                        cache: false,
                    });
                }


            });
            // End data pass



            // Pass Data to Controller
            $("#form1").submit(function (event) {
                // $('.checkbox').each(function () {
                //     document.getElementById().innerHTML = id[0];
                // }

                    event.preventDefault();
                    {{--$.blockUI({ message:'{{__('please wait...')}}', css: {--}}
                    {{--border: 'none',--}}
                    {{--padding: '15px',--}}
                    {{--backgroundColor: '#000',--}}
                    {{--'-webkit-border-radius': '10px',--}}
                    {{--'-moz-border-radius': '10px',--}}
                    {{--opacity: .5,--}}
                    {{--color: '#fff'}--}}
                    {{--});--}}
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/order-state/'+data.id,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                            // setTimeout($.unblockUI, 2000);
                        },
                        cache: false,
                    });
                });
                // End Pass
            });

    </script>
@endpush