@extends('layouts.app')

@section('title',__('Finance'))

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
                    <a href="{{route('type.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i> &nbsp;
                        {{__('New Help Desk Type')}}
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Help Desk Type List')}}</h4>
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
                                                {{__('Project Name')}}
                                            </th>
                                            <th>
                                                {{__('Paid Code')}}
                                            </th>
                                            <th>
                                                {{__('Action')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($order as $orders)
                                                <tr>
                                                    <form id="form1">
                                                        <td>
                                                            {{$orders ->hpo_order_id}}
                                                            <input class="id" value="{{$orders->hpo_order_id}}"  hidden data-id="{{$orders->hpo_order_id}}">
                                                        </td>
                                                        <td>
                                                            {{$orders ->hp_project_name}}
                                                        </td>
                                                        <td>
                                                            <input class="form-control code" type="number"
                                                                   name="hf_paid_code">
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
                                                                    <button type="submit"
                                                                            class="dropdown-item">{{__('Send')}}</button>
                                                    </form>

                                                    <a class="dropdown-item"
                                                       href="{{route('type.edit',$orders->hpo_order_id)}}"
                                                    >{{__('Edit')}}</a>
                                                    <form id="-form-delete{{$orders->hpo_order_id}}"
                                                          style="display: none;" method="POST"
                                                          action="{{route('type.destroy',$orders->hpo_order_id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item"
                                                       onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                               event.preventDefault();
                                                               document.getElementById('-form-delete{{$orders->hpo_order_id}}').submit();
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
    {{--@endcan--}}
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>

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

            //pass form data
            $("#form1").submit(function (event) {
                var code = $(".code").val();
                var data = {
                    id:$(".id").data('id'),
                    code:code,
                }
                event.preventDefault();
                $.blockUI();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
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
                $.ajax({
                    url: '/finance/'+ data.id,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    method:'PUT',
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        location.reload();
                    },
                    cache: false,
                });
            });

        });
    </script>
@endpush