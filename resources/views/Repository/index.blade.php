@extends('layouts.app')

@section('title',__('Invoices List'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin||product||repository')
    <div class="content persian">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    {{--Repository Product Data List--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('inventory Repository Product')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" cellspacing="0" width="100%">
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
                                        <th>
                                            {{__('Action')}}
                                        </th>
                                        </thead>
                                        <tbody>

                                        @foreach($repository_product as $key => $repository_products)
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                @foreach($product as $products)
                                                    @if($products->id == $repository_products ->hr_product_id)
                                                        <td>
                                                            {{$products->hp_product_name}}
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    {{$repository_products ->hr_product_stock}}
                                                </td>
                                                <td>
                                                    {{$repository_products ->hr_comment}}
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
                                                               href="{{route('repository.edit',$repository_products->id)}}"
                                                            >{{__('Edit')}}</a>
                                                            <form id="-form-delete{{$repository_products->id}}"
                                                                  style="display: none;" method="POST"
                                                                  action="{{route('repository.destroy',$repository_products->id)}}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <a class="dropdown-item"
                                                               onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                       event.preventDefault();
                                                                       document.getElementById('-form-delete{{$repository_products->id}}').submit();
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
                    {{--End Repository Product Data List--}}

                    {{--Order Data List--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Order List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" cellspacing="0" width="100%">
                                        <thead class=" text-primary">
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Order ID')}}
                                        </th>
                                        <th>
                                            {{__('Registrant Name')}}
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
                                            @if($orders_show->hpo_status == '3')
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    <td>
                                                        {{$orders_show -> hpo_order_id}}
                                                    </td>

{{--                                                        @if(auth()->user()->id == $orders_show ->hp_registrant)--}}
                                                            <td>
                                                                {{auth()->user()->name}}
                                                            </td>
                                                        {{--@endif--}}

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
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--End Order Data List--}}
                </div>
                @role('Admin||product')
                {{--Requirement Product List--}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-tasks">
                            {{--Drop Done Show Details Product List--}}
                            <div class="card-header ">
                                @foreach($order_all as $orders_all)
                                    @foreach($repository_product_count as $repository_product_counts)
                                        @if($orders_all->sum_hpo-$repository_product_counts->sum_hpo   <= 0)
                                            <h6 class="title d-inline">{{__('Inventory Deficit')}}</h6>
                                            {{  $repository_product_counts->sum_hpo - $orders_all->sum_hpo  }}
                                        @endif
                                    @endforeach
                                @endforeach
                                <p class="card-category d-inline">

                                </p>
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
                                    <table class="table">
                                        <tbody>
                                        <thead>
                                        <th><p class="title">{{__('Order ID')}}</p></th>
                                        <th><p class="title">{{__('Product Name')}}</p></th>
                                        <th><p class="title">{{__('Inventory')}}</p></th>
                                        <th><p class="title">{{__('Status Verify')}}</p></th>
                                        </thead>
                                        @foreach($orders as $item)
                                            @if($item->hpo_status == "3")
                                                @foreach($product as $goods)
                                                    @foreach($repository_product as $repository_selected)
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

                                                                            </td>
                                                                            {{--<td class="td-actions text-right">--}}
                                                                            {{--<button type="button" rel="tooltip" title=""--}}
                                                                            {{--class="btn btn-link"--}}
                                                                            {{--data-original-title="Edit Task">--}}
                                                                            {{--<i class="tim-icons icon-pencil"></i>--}}
                                                                            {{--</button>--}}
                                                                            {{--</td>--}}
                                                                            @if($repository_selected ->hr_product_stock - $item->hpo_count >= 0 )
                                                                                <td>
                                                                                    <div class="form-check ">
                                                                                        <label class="form-check-label">
                                                                                            <input class="form-check-input checkbox"
                                                                                                   type="checkbox"
                                                                                                   data-id="{{$item->hpo_order_id}}"
                                                                                                   data-pid="{{$item->hpo_product_id}}"
                                                                                                   data-computing_repository_requirement="{{$repository_selected ->hr_product_stock - $item->hpo_count}}"
                                                                                            >
                                                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                                </span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            @else()
                                                                                <td>
                                                                                    <div class="form-check ">
                                                                                        <label class="form-check-label">
                                                                                            <input class="form-check-input checkbox"
                                                                                                   type="checkbox"
                                                                                                   disabled>
                                                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                                </span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            @endif
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--End Requirement Product List--}}
                @endrole

                <div class="col-md-12">
                    <div class="row">
                        {{--Repository Middle Part List--}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Repository Middle Part List')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" cellspacing="0" width="100%">
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Name')}}
                                            </th>
                                            <th>
                                                {{__('Count')}}
                                            </th>
                                            <th>
                                                {{__('Description')}}
                                            </th>
                                            <th>
                                                {{__('Action')}}
                                            </th>
                                            </thead>
                                            <tbody>
                                            @foreach($repository_middle_part as $key => $repository_middle_parts)
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    @foreach($middle_part as $middle_parts)
                                                        @if($middle_parts->id == $repository_middle_parts ->hrm_middle_part_id)
                                                            <td>
                                                                {{$middle_parts->hmp_name}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    <td>
                                                        {{$repository_middle_parts ->hrm_count}}
                                                    </td>
                                                    <td>
                                                        {{$repository_middle_parts ->hrm_comment}}
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
                                                                   href="{{route('repository-middle-part.edit',$repository_middle_parts->id)}}"
                                                                >{{__('Edit')}}</a>
                                                                <form id="-form-delete{{$repository_middle_parts->id}}"
                                                                      style="display: none;" method="POST"
                                                                      action="{{route('repository-middle-part.destroy',$repository_middle_parts->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a class="dropdown-item"
                                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                           event.preventDefault();
                                                                           document.getElementById('-form-delete{{$repository_middle_parts->id}}').submit();
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
                        {{--End Repository Middle Part List--}}

                        {{--Repository Part List--}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Repository Part List')}}</h4>
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
                                                {{__('Count')}}
                                            </th>
                                            <th>
                                                {{__('Repository')}}
                                            </th>
                                            <th>
                                                {{__('Action')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($repository as $key => $repositories)
                                                <tr>

                                                    <td>
                                                        {{$key+1}}
                                                    </td>

                                                    @foreach($part as $parts)
                                                        @if( $repositories ->hrp_part_id == $parts->id)
                                                            <td>
                                                                {{$parts->hp_name}}
                                                            </td>
                                                        @endif
                                                    @endforeach

                                                    @foreach($repository_name as $repository_names)
                                                        @if( $repositories ->hrp_repository_id == $repository_names->id)
                                                            <td>
                                                                {{$repository_names -> hr_name}}
                                                            </td>
                                                        @endif
                                                    @endforeach

                                                    <td>
                                                        {{$repositories -> hrp_part_count}}
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
                                                                   href="{{route('repository-part.edit',$repositories->id)}}"
                                                                >{{__('Edit')}}</a>
                                                                <form id="-form-delete{{$repositories->id}}"
                                                                      style="display: none;" method="POST"
                                                                      action="{{route('repository-part.destroy',$repositories->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a class="dropdown-item"
                                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                           event.preventDefault();
                                                                           document.getElementById('-form-delete{{$repositories->id}}').submit();
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
                        {{--end--}}
                    </div>
                </div>
            </div>
            {{--End Repository Part List--}}
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
                                </thead> @foreach($query as $item)
                                    @foreach($repository_product as $repository_stock)
                                        @if($item->hpo_product_id == $repository_stock->hr_product_id and $item->hpo_status == '3')
                                            <input type="hidden" class="product-id"
                                                   data-id[]="{{$item->hpo_product_id}}">
                                            <input type="hidden" class="inventory-deficit"
                                                   data-inventory-deficit=" {{$item->sum_hpo}}">
                                            <input type="hidden" class="product-stock"
                                                   data-product-stock=" {{$item->sum_hpo - $repository_stock->hr_product_stock}}">
                                            <tr>
                                                @foreach($product as $products)
                                                    @if($item->hpo_product_id == $products->id)
                                                        <td>
                                                            {{$products->hp_product_name}}
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    {{$item->sum_hpo}}
                                                </td>
                                                <td>
                                                    {{$item->sum_hpo - $repository_stock->hr_product_stock}}
                                                </td>
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
                                    class="btn btn-deep-orange" form="modal_form"
                                    value="Submit">{{__('Request Send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endrole

@endsection
@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {// Data Table

            // Modal Form

            $('#modal_form').submit(function (event) {
                var data = {
                    Product_Id: $('.product-id').data('id[]'),
                    Inventory_deficit: $('.inventory-deficit').data('inventory-deficit'),
                    Product_Count: $('.product-stock').data('product-stock'),
                }
                event.preventDefault();
                $.blockUI({
                    message: '{{__('please wait...')}}', css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });
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
                        alert('ok');
                        setTimeout($.unblockUI, 2000);
                        $("#modalRegisterForm").modal('hide');
                    },
                    cache: false,
                });
            });

            // End Modal Form

            // pass checkbox data

            $('.checkbox').on('change', function (event) {
                if (event.target.checked) {
                    var data = {
                        id: $(this).data('id'),
                        state: $(this)[0].checked == true ? 3 : 2,
                        product: $(this).data('pid'),
                        computing_repository_requirement: $(this).data('computing_repository_requirement'),

                    };
                    $.blockUI({
                        message: '{{__('please wait...')}}', css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                    //token
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/order-state/' + data.id,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                            alert(data.response);
                            setTimeout($.unblockUI, 2000);
                            location.reload();
                        },
                        cache: false,
                    });
                }


            });
            // End data pass
        });

    </script>


    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    {{--<script>--}}
    {{--$(document).ready(function () {--}}

    {{--var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));--}}

    {{--$('#table').on('click', 'button', function (event) {--}}

    {{--var data = table.row($(this).parents('tr')).data();--}}
    {{--$.ajaxSetup({--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--}--}}
    {{--});--}}
    {{--swal({--}}
    {{--// title: "",--}}
    {{--text: "{{__('Are you sure?')}}",--}}
    {{--buttons: ["{{__('cancel')}}", "{{__('Done')}}"],--}}
    {{--icon: "warning",--}}
    {{--// buttons: true,--}}
    {{--dangerMode: true,--}}
    {{--})--}}
    {{--.then((willDelete) => {--}}
    {{--if (willDelete) {--}}
    {{--$.ajax({--}}
    {{--url: '/order-destroy/' + data[0],--}}
    {{--type: 'delete',--}}
    {{--data: data,--}}
    {{--dataType: 'json',--}}
    {{--async: false,--}}
    {{--success: function (data) {--}}
    {{--swal("{{__("Poof! Your imaginary file has been deleted!")}}", {--}}
    {{--icon: "success",--}}
    {{--button: "{{__('Done')}}",--}}
    {{--});--}}
    {{--},--}}
    {{--cache: false,--}}
    {{--});--}}
    {{--location.reload();--}}
    {{--} else {--}}
    {{--swal(--}}
    {{--"{{__("Your imaginary file is safe!")}}",--}}
    {{--{button: "{{__('Done')}}"}--}}
    {{--);--}}

    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--var table = $('#table').on('draw.dt', function (e, settings, json, xhr) {--}}
    {{--}).DataTable({--}}

    {{--"processing":--}}
    {{--true,--}}
    {{--"serverSide":--}}
    {{--true,--}}
    {{--"ajax":--}}
    {{--'/json-data-order',--}}
    {{--"columnDefs":--}}
    {{--[{--}}
    {{--"targets": -1,--}}
    {{--"data": null,--}}
    {{--"defaultContent": "  <div class=\"dropdown\">\n" +--}}
    {{--"                                                            <a class=\"btn btn-link dropdown-toggle btn-icon\"\n" +--}}
    {{--"                                                                    data-toggle=\"dropdown\">\n" +--}}
    {{--"                                                                <i class=\"tim-icons icon-settings-gear-63\"></i>\n" +--}}
    {{--"                                                            </a>\n" +--}}
    {{--"                                                            <div class=\"dropdown-menu dropdown-menu-right\"\n" +--}}
    {{--"                                                                 aria-labelledby=\"dropdownMenuLink\">\n" +--}}
    {{--"                                                                <a href=\"{{route('order.edit',113)}}\" class=\"dropdown-item\"\n" +--}}
    {{--"                                                                >{{__('Edit')}}</a>\n" +--}}
    {{--"                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +--}}
    {{--"                                                            </div>\n" +--}}
    {{--"                                                        </div>"--}}
    {{--}, {--}}
    {{--"targets": -2,--}}
    {{--"data": null,--}}
    {{--"defaultContent": '  <div class="progress">\n' +--}}
    {{--'                                                            @foreach($order as $orders)\n' +--}}
    {{--'                                                            @foreach($progress as $progresses)\n' +--}}
    {{--// '                                                                <span class="progress-value">25%</span>\n' +--}}
    {{--'                                                                @if($progresses->ho_process_id == 1 and $orders->id == $progresses->order_id )\n' +--}}
    {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
    {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
    {{--'                                                                         aria-valuemax="100"\n' +--}}
    {{--'                                                                         style="width: 25%;"></div>\n' +--}}
    {{--'                                                                @endif\n' +--}}
    {{--'                                                                @if($progresses->ho_process_id == 2 and $orders->id == $progresses->order_id)\n' +--}}
    {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
    {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
    {{--'                                                                         aria-valuemax="100"\n' +--}}
    {{--'                                                                         style="width: 50%;"></div>\n' +--}}
    {{--'                                                                @endif\n' +--}}
    {{--'                                                                @if($progresses->ho_process_id == 3 and $orders->id == $progresses->order_id)\n' +--}}
    {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
    {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
    {{--'                                                                         aria-valuemax="100"\n' +--}}
    {{--'                                                                         style="width: 75%;"></div>\n' +--}}
    {{--'                                                                @endif\n' +--}}
    {{--'                                                                @if($progresses->ho_process_id == 4 and $orders->id == $progresses->order_id )\n' +--}}
    {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
    {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
    {{--'                                                                         aria-valuemax="100"\n' +--}}
    {{--'                                                                         style="width:100%; direction: ltr"></div>\n' +--}}
    {{--'                                                                @endif\n' +--}}
    {{--'                                                            @endforeach\n' +--}}
    {{--'                                                            @endforeach\n' +--}}
    {{--'                                                        </div>'--}}
    {{--}],--}}
    {{--"language":--}}
    {{--{--}}
    {{--"sEmptyTable":--}}
    {{--"هیچ داده ای در جدول وجود ندارد",--}}
    {{--"sInfo":--}}
    {{--"نمایش _START_ تا _END_ از _TOTAL_ رکورد",--}}
    {{--"sInfoEmpty":--}}
    {{--"نمایش 0 تا 0 از 0 رکورد",--}}
    {{--"sInfoFiltered":--}}
    {{--"(فیلتر شده از _MAX_ رکورد)",--}}
    {{--"sInfoPostFix":--}}
    {{--"",--}}
    {{--"sInfoThousands":--}}
    {{--",",--}}
    {{--"sLengthMenu":--}}
    {{--"نمایش _MENU_ رکورد",--}}
    {{--"sLoadingRecords":--}}
    {{--"در حال بارگزاری...",--}}
    {{--"sProcessing":--}}
    {{--"در حال پردازش...",--}}
    {{--"sSearch":--}}
    {{--"جستجو:",--}}
    {{--"sZeroRecords":--}}
    {{--"رکوردی با این مشخصات پیدا نشد",--}}
    {{--"oPaginate":--}}
    {{--{--}}
    {{--"sFirst":--}}
    {{--"ابتدا",--}}
    {{--"sLast":--}}
    {{--"انتها",--}}
    {{--"sNext":--}}
    {{--"بعدی",--}}
    {{--"sPrevious":--}}
    {{--"قبلی"--}}
    {{--}--}}
    {{--,--}}
    {{--"oAria":--}}
    {{--{--}}
    {{--"sSortAscending":--}}
    {{--": فعال سازی نمایش به صورت صعودی",--}}
    {{--"sSortDescending":--}}
    {{--": فعال سازی نمایش به صورت نزولی"--}}
    {{--}--}}
    {{--}--}}
    {{--})--}}
    {{--;--}}
    {{--});--}}
    {{--</script>--}}
@endpush