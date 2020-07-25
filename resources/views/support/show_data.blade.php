@extends('layouts.app')

@section('title',__('Response Support Request'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|support')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                {{--<div class="col-md-12">--}}
                {{--@include('layouts.partial.Msg')--}}
                {{--</div>--}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Send Response')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Title')}}</label>
                                            <input hidden value="{{$support_response->hs_project_id}}" id="project_id">
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled name="hs_title"
                                                   id="hs_title"
                                                   value="{{$support_response->hs_title}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Request User Name')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled name="hs_request_user_id"
                                                   id="hs_request_user_id"
                                                   value="{{$user_requested->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Response User Name')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled
                                                   value="{{$user_response->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Name')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled name="hp_project_name"
                                                   id="hp_project_name"
                                                   value="{{$project->hp_project_name}}">
                                            <input type="hidden" id="project_id" value="{{$project->id}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Owner')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled
                                                   value="{{$client_name->hc_name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Owner Phone')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled
                                                   value="{{$project->hp_project_owner_phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Type')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled
                                                   value="{{$project->hp_project_type}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Project Address')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled
                                                   value="{{$project->hp_project_address}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Project Description')}}</label>
                                            <textarea name="hs_description" id="hs_description" rows="4" cols="80"
                                                      class="form-control" name="hs_title"
                                                      disabled>{{$support_response->hs_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @if($support_response->hs_attach_file != "")
                                <a href="{{asset('img/support_request/' . $support_response->hs_attach_file)}}">{{__('Download Attached File')}}</a>
                                @endif
                                @if($support_response->hs_response != "")
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Support Response')}}</label>
                                            <textarea rows="4" cols="80"
                                                      class="form-control" disabled
                                            >{{$support_response->hs_response}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Support New Response')}}</label>
                                            <textarea rows="4" cols="80"
                                                      class="form-control" name="hs_response" id="hs_response"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <table id="table2" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Title')}}
                                    </th>
                                    <th>
                                        {{__('Project Name')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    {{--<th>--}}
                                    {{--{{__('action')}}--}}
                                    {{--</th>--}}
                                    </thead>
                                </table>
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
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#table2').DataTable({
                "initComplete": function (settings, json) {
                    $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                },
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax": {
                    url: '/json-data-support-recent-list',
                    'data': {
                        formName: $('#project_id').val(),
                    },
                },
                "columnDefs":
                    [{
                        "targets": 1,
                        "data": null,
                        "render": function (data, type, row, meta) {
                            return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Title')}} : " + data[1] + "<br><br> {{__('Project Name')}} : " + data[2] + "<br><br> {{__('Request User Name')}} : " + data[9] + "<br><br> {{__('Description')}} :" + data[7] + "<br><br> {{__('Response')}} :" + data[8] + "<br><br> {{__('Status')}} : " + data[3] + "<br><br> {{__('Created at')}} : " + data[4] + "\">\"" + data[1] + "</span>"
                        }
                    }],
                "language":
                    {
                        "sEmptyTable":
                            "هیچ داده ای در جدول وجود ندارد",
                        "sInfo":
                            "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                        "sInfoEmpty":
                            "نمایش 0 تا 0 از 0 رکورد",
                        "sInfoFiltered":
                            "(فیلتر شده از _MAX_ رکورد)",
                        "sInfoPostFix":
                            "",
                        "sInfoThousands":
                            ",",
                        "sLengthMenu":
                            "نمایش _MENU_ رکورد",
                        "sLoadingRecords":
                            "در حال بارگزاری...",
                        "sProcessing":
                            "در حال پردازش...",
                        "sSearch":
                            "جستجو:",
                        "sZeroRecords":
                            "رکوردی با این مشخصات پیدا نشد",
                        "oPaginate":
                            {
                                "sFirst":
                                    "ابتدا",
                                "sLast":
                                    "انتها",
                                "sNext":
                                    "بعدی",
                                "sPrevious":
                                    "قبلی"
                            }
                        ,
                        "oAria":
                            {
                                "sSortAscending":
                                    ": فعال سازی نمایش به صورت صعودی",
                                "sSortDescending":
                                    ": فعال سازی نمایش به صورت نزولی"
                            }
                    }
            });

            $("#form1").submit(function (event) {
                var data = {
                    hs_request_user_id: $('#hs_request_user_id').val(),
                    hp_project_name: $('#hp_project_name').val(),
                    hs_description: $('#hs_description').val(),
                    hs_response: $('#hs_response').val(),
                    hs_title: $('#hs_title').val(),
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
                    url: '/support',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                    },
                    cache: false,
                });
            });
        });
    </script>
@endpush