@extends('layouts.app')

@section('title',__('Repository'))

@push('css')
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Increase inventory Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">{{__('Product Name')}}</label>
                                        <div class="form-group">
                                            <select class="form-control select-product" name="hr_product_id">
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Repository Name')}}</label>
                                            <select class="form-control" name="hr_repository_id">
                                                @foreach($repository_name as $namess)
                                                    <option value="{{$namess->id}}">
                                                        {{$namess->hr_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Count')}}</label>
                                            <input type="number" class="form-control" required=""
                                                   aria-invalid="false" name="hr_product_stock">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Provider')}}</label>
                                            <select class="form-control"
                                                    aria-invalid="false" name="hr_provider_code">
                                                @foreach($provider as $providers)
                                                    <option value="{{$providers->id}}">
                                                        {{$providers->hp_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm">
                                                    {{__('Add New Provider')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                            <input class="form-control" required=""
                                                   aria-invalid="false" name="hr_entry_date" id="test-date-id"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Comment')}}</label>
                                            <textarea class="form-control" required=""
                                                      aria-invalid="false" name="hr_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>
                                    <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Increase inventory Middle Part')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">{{__('Name')}}</label>
                                        <div class="form-group">
                                            <select class="form-control select-middle-part" name="hrm_middle_part_id">
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Repository Name')}}</label>
                                            <select class="form-control" name="hrm_repository_id">
                                                @foreach($repository_name as $names)
                                                    <option value="{{$names->id}}">
                                                        {{$names->hr_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Count')}}</label>
                                            <input type="number" class="form-control" required=""
                                                   aria-invalid="false" name="hrm_count">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Provider')}}</label>
                                            <select class="form-control"
                                                    aria-invalid="false" name="hrm_provider_code">
                                                @foreach($provider as $providers)
                                                    <option value="{{$providers->id}}">
                                                        {{$providers->hp_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm">
                                                    {{__('Add New Provider')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                            <input class="form-control" required=""
                                                   aria-invalid="false" name="hrm_entry_date" id="test-date-id-1"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Comment')}}</label>
                                            <textarea class="form-control" required=""
                                                      aria-invalid="false" name="hrm_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<label class="bmd-label-floating">{{__('Status Return Part')}}</label>--}}
                                {{--<input class="form-control" required=""--}}
                                {{--aria-invalid="false" name="hr_status_return_part">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="row form-group">
                                    <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>
                                    <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('New Part To Repository')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">{{__('Part Name')}}</label>
                                        <div class="form-group">
                                            <select class="form-control select-part" name="hrp_part_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Repository Name')}}</label>
                                            <select class="form-control" name="hrp_repository_id">
                                                @foreach($repository_name as $name)
                                                    <option value="{{$name->id}}">
                                                        {{$name->hr_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Count')}}</label>
                                            <input class="form-control" required=""
                                                   aria-invalid="false" name="hrp_part_count">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Provider')}}</label>
                                            <select class="form-control"
                                                    aria-invalid="false" name="hrp_provider_code">
                                                @foreach($provider as $providers)
                                                    <option value="{{$providers->id}}">
                                                        {{$providers->hp_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm">
                                                    {{__('Add New Provider')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                            <input class="form-control" required=""
                                                   aria-invalid="false" name="hrp_entry_date" id="test-date-id-1"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Comment')}}</label>
                                            <textarea class="form-control" required=""
                                                      aria-invalid="false" name="hrp_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                                <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--//Provider Details Modal//--}}
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{__('New Provider')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="modal_form" enctype="multipart/form-data">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <div class="form-group" data-success="right">
                                <label class="bmd-label-floating" style="float: right">{{__('Name')}}</label>
                                <input class="form-control" name="hp_name">
                            </div>
                        </div>
                        <div class="md-form mb-5">
                            <label class="bmd-label-floating" style="float: right">{{__('Phone')}}</label>
                            <input name="hp_phone" type="number" class="form-control" required=""
                                   aria-invalid="false">
                        </div>
                        <div class="md-form mb-5">
                            <label class="bmd-label-floating" style="float: right">{{__('Address')}}</label>
                            <input name="hp_address" type="text" class="form-control" required=""
                                   aria-invalid="false">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" id="modal_form"
                                class="btn btn-deep-orange">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--end modal--}}
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            // pass product data
            $("#form1").submit(function (event) {
                var data = $("#form1").serialize();
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
                    url: '/repository',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        location.reload();
                    },
                    cache: false,
                });
            });
            // pass middle part data
            $("#form2").submit(function (event) {
                var data = $("#form2").serialize();
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
                    url: '/repository-middle-part',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        location.reload();
                    },
                    cache: false,
                });
            });

            // pass part data
            $("#form3").submit(function (event) {
                var data = $("#form3").serialize();
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
                    url: '/repository-part',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/repository_part";
                    },
                    cache: false,
                });
            });

            // pass  provider data
            $("#modal_form").submit(function (event) {
                var data = $("#modal_form").serialize();
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/provider',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        $("#modalRegisterForm").modal('hide');
                        $("#provider").append('<option selected>' + data.provider + '</option>');

                    },
                    cache: false,
                });
            });

            // fill data in select middle part
            $(".select-middle-part").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill_data_repository_middle_part',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        }
                    }
                },
                theme: "bootstrap",
                placeholder: ('انتخاب قطعه میانی'),
                templateResult: formatRepo1,
                templateSelection: formatRepoSelection1
            });

            function formatRepo1(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='/img/middle_parts/" + repo.hmp_image + "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text("{{__('Name')}}" + " : " + repo.text);
                $container.find(".select2-result-repository__description").text("{{__('Model')}}" + " : " + repo.hmp_middle_part_model);
                $container.find(".select2-result-repository__color").text("{{__('Code')}}" + " : " + repo.hmp_serial_number);

                return $container;
            }

            function formatRepoSelection1(repo) {
                return repo.text || repo.id;
            }

            // end fill data in select middle part

            // fill data in select product
            $(".select-product").select2({
                ajax: {
                    url: '/json-data-fill_data_repository_product',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        }
                    }
                },
                theme: "bootstrap",
                dir: 'rtl',
                placeholder: ('انتخاب محصول'),
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
                // allowClear: true

            });

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }
                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='/img/products/" + repo.hp_product_image + "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    // "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
                    // "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
                    // "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(repo.text);
                $container.find(".select2-result-repository__description").text("{{__('Price')}}" + " : " + repo.hp_product_price);
                $container.find(".select2-result-repository__color").text("{{__('Color')}}" + " : " + repo.hn_color_name);
                $container.find(".select2-result-repository__statistics").text("{{__('Property')}}" + " : " + repo.hpp_property_name + repo.hppi_items_name);
                // $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
                // $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
                // $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");
                return $container;

            }

            function formatRepoSelection(repo) {
                return repo.text
            }

            // end

            // fill data in select part
            $(".select-part").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill_data_repository_part',
                    dataType: 'json',
                    method: 'put',
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        }
                    }
                },
                theme: "bootstrap",
                placeholder: ('انتخاب قطعه'),
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='/img/parts/" + repo.hp_part_image + "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text("{{__('Name')}}" + " : " + repo.text);
                $container.find(".select2-result-repository__description").text("{{__('Model')}}" + " : " + repo.hp_part_model);
                $container.find(".select2-result-repository__color").text("{{__('Code')}}" + " : " + repo.hp_serial_number);

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.text || repo.id;
            }

            // end fill data in select middle part
        });
    </script>
    {{--datapicker--}}
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script>
        kamaDatepicker('test-date-id', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
        kamaDatepicker('test-date-id-1', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
    </script>
@endpush