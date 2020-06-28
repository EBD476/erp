@extends('layouts.app')

@section('title',__('Create Serial Number Status'))

@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/switchery.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Create Serial Number Status')}}</h4>
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

                                            @foreach($status as $statuses)
                                                <tr>
                                                    <td>
                                                        {{$statuses ->id}}
                                                        <input hidden name="id" id="id" value="{{$statuses ->id}}" >
                                                    </td>
                                                    <td>
                                                        {{$statuses -> hpscsn_status}}
                                                        <input hidden name="hpscsn_status" id="hpscsn_status" value="{{$statuses ->hpscsn_status}}" >
                                                    </td>
                                                    <td>
{{--                                                        {{$statuses -> hpscsn_activation}}--}}
                                                        <input type="checkbox" class="js-switch" data-size="small" @if($statuses -> hpscsn_activation) checked @endif>
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
                                    <div class="card-description"></div>
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
    <script src="{{asset('assets/js/switchery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {

            // var data = table.row($(this).parents('tr')).data();
            var switchery = new Switchery($(this)[0], $(this).data());

            // data[12] == 1 ? $(this)[0].click() : 0;

            $(this)[0].onchange = function () {
                var data = {
                    id: $('#id').val(),
                    hp_status: $('#hpscsn_status').val(),
                    hp_status_activation: $(this)[0].checked == true ? 1 : 0
                };
                //token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/activation-create-serial-number-status/' + data.id,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        swal({
                            title: "",
                            text: "{{__('success')}}",
                            icon: "success",
                            button: "{{__('Done')}}"
                        })
                    },
                    cache: false,
                });
            }
        })
    </script>
@endpush