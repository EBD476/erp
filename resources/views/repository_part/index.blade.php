@extends('layouts.app')

@section('title',__('Repository'))

@push('script')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('repository-part.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i> &nbsp;
                        {{__('New Part To Repository')}}
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Repository Part List')}}</h4>
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
                                                    <td>
                                                        {{$repositories -> hrp_repository_id}}
                                                    </td>
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