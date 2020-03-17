@extends('layouts.app')

@section('title',__('Help Desk'))

@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--                    @can('browse-btn-user')--}}
                    <a href="{{route('help_desk.create')}}" class="btn btn-primary float-left mb-lg-2"><i
                                class="tim-icons icon-simple-add"></i>{{__('Add New Help Desk')}}</a>
                </div>
                {{--@endcan--}}
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Help Desk')}}</h4>
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
                                                {{__('Title')}}
                                            </th>
                                            <th>
                                                {{__('Ticket Id')}}
                                            </th>
                                            <th>
                                                {{__('Priority')}}
                                            </th>
                                            <th>
                                                {{__('Status')}}
                                            </th>
                                            <th>
                                                {{__('Create At')}}
                                            </th>
                                            <th>
                                                {{__('action')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($help_desks as $key => $help_desk_index)
                                                @if(auth()->user()->id == $help_desk_index ->hhd_receiver_user_id or auth()->user()->name == 'admin')
                                                    <tr>
                                                        <td>
                                                            {{$key + 1}}
                                                        </td>
                                                        <td>
                                                            {{$help_desk_index -> hhd_title}}
                                                        </td>
                                                        <td>
                                                            {{$help_desk_index -> hhd_ticket_id}}
                                                        </td>
                                                        <td>
                                                            {{$help_desk_index -> hhd_periority}}
                                                        </td>
                                                        @foreach($ticket_status as $ticket_statuses)
                                                            @if($ticket_statuses->id == $help_desk_index->hhd_ticket_status)
                                                                <td>
                                                                    {{$ticket_statuses->ts_name}}
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                        <td>
                                                            {{$help_desk_index -> created_at}}
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
                                                                       href="{{route('help_desk.receive_show',$help_desk_index->id)}}"
                                                                    >{{__('Show')}}</a>
                                                                    <form id="-form-delete{{$help_desk_index->id}}"
                                                                          style="display: none;" method="POST"
                                                                          action="{{route('help_desk.destroy',$help_desk_index->id)}}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                    <a class="dropdown-item"
                                                                       onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                               event.preventDefault();
                                                                               document.getElementById('-form-delete{{$help_desk_index->id}}').submit();
                                                                               }else {
                                                                               event.preventDefault();}">{{__('Delete')}}</a>
                                                                </div>
                                                            </div>
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
    {{--@endcan--}}
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
                                {{--url: '/product-destroy/' + data[0],--}}
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
                        {{--'/json-data-product',--}}
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