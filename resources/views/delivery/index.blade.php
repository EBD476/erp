@extends('layouts.app')

@section('title',__('Delivery List'))

@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Delivery List')}}</h4>
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
                                                {{__('Status')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($invoice_status as  $invoice_statuses)
                                                <tr>
                                                    <td>
                                                        {{$invoice_statuses ->hp_Invoice_number}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hp_project_name}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hpo_product_id}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hpo_count}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hop_due_date}}
                                                    </td>
                                                    <td>
                                                        <div class="form-check ">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input checkbox"
                                                                       type="checkbox"
                                                                       data-id="{{$invoice_statuses->hpo_order_id}}">
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                                </span>
                                                            </label>
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
                <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
                <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
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

                    // pass checkbox data
                    $('.checkbox').on('change', function (event) {
                        if (event.target.checked) {
                            var data = {
                                id: $(this).data('id'),
                                state: $(this)[0].checked == true ? 2 : 4,

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
                                url: '/delivery/' + data.id,
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                async: false,
                                method:'PUT',
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

                </script>
    @endpush