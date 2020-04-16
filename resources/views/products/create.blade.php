@extends('layouts.app')

@section('title',__('Products'))

@push('css')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endpush


@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('New Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Name')}}</label>
                                            <input name="product_name" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Model')}}</label>
                                            <input name="product_model" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <label>{{__('Product Color')}}</label>
                                        <div class="form-group">
                                            <select class="select-item-color form-control" name="hp_product_color_id"
                                                    id="hp_product_color_id">
                                            </select>
                                        </div>
                                        <div class="text-light">
                                            <a class="pointer" href="#" data-toggle="modal"
                                               data-target="#modalRegisterForm">
                                                {{__('Add New Color')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row select-to-input">
                                    <div class="col-md-6 pr-md-1">
                                        <label>{{__('Product Property')}}</label>
                                        <div class="form-group">
                                            <select class="select-product-property form-control"
                                                    name="hp_product_property" id="hp_product_property">
                                            </select>
                                        </div>
                                        <div class="text-light">
                                            <a class="pointer" href="#" data-toggle="modal"
                                               data-target="#modalRegisterForm1">
                                                {{__('Add New Property')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row select-to-input">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Size')}}</label>
                                            <input name="hp_product_size" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Price')}}</label>
                                            <input name="product_price" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input name="hp_description" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product_image" id="product_image">
                            </form>
                            <br>
                            <label style="margin-top: -20px;">{{__('Image')}}</label>
                            <div class="card-body col-md-6 pr-md-1 row"
                                 style="display: flex ; border: 1px dashed;     margin-right: -35px;}">
                                <form action="{{url('/product-image-save')}}" class="dropzone" id="dropzone"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input type="file" class="form-control"
                                               name="file" multiple>
                                    </div>
                                </form>
                            </div>
                            <br>
                        </div>

                        <div class="card-footer">
                            <button id="sub_form1" type="submit"
                                    class="btn btn-fill btn-primary">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
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
                                {{--<p class="description">--}}
                                {{--Product--}}
                                {{--</p>--}}
                            </div>
                            </p>
                            <div class="card-description">

                            </div>
                        </div>
                        <div class="card-footer">
                            {{--<div class="button-container">--}}
                            {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">--}}
                            {{--<i class="fab fa-facebook"></i>--}}
                            {{--</button>--}}
                            {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">--}}
                            {{--<i class="fab fa-twitter"></i>--}}
                            {{--</button>--}}
                            {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">--}}
                            {{--<i class="fab fa-google-plus"></i>--}}
                            {{--</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--//product color modal//--}}
        <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">{{__('Add New Color')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                {{--<i class="fas fa-user prefix grey-text"></i>--}}
                                <label class="bmd-label-floating" data-error="wrong"
                                       data-success="right"
                                       for="orangeForm-name" style="display: flex;">{{__('Product Color Name')}}</label>
                                <input type="text" id="orangeForm-name" class="form-control validate"
                                       name="hn_color_name">
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" id="submit_modal_color"
                                    class="btn btn-deep-orange">{{__('Send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--//End color modal//--}}

        {{--//property modal//--}}
        <div class="modal fade" id="modalRegisterForm1" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">{{__('Add New Property')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="modal_form" enctype="multipart/form-data">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                {{--<i class="fas fa-user prefix grey-text"></i>--}}
                                <label style="display: flex;">{{__('Property Name')}}</label>
                                <input name="hpp_property_name" type="text" class="form-control" required=""
                                       aria-invalid="false">
                            </div>
                            <div class="md-form mb-5">
                                {{--<i class="fas fa-envelope prefix grey-text"></i>--}}
                                <div class="form-group">
                                    <label style="display: flex;margin-top: -40px;margin: -20px;margin-right: 4px;">{{__('Items')}}</label>
                                    <select name="hpp_property_items" class="select-item-item form-control"></select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-deep-orange">{{__('Send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--//End property modal//--}}
        @endrole
        @endsection

        @push('scripts')
            <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/js/plugins/dropzone.js')}}"></script>
            <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
            <script>
                $(document).ready(function () {

                    var locale = $("#form1").data('lang');

                    $(".select-item-color").select2({
                        ajax: {
                            dir: "rtl",
                            language: "fa",
                            url: '/json-data-fill_data_product_color',
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
                        placeholder: ('انتخاب رنگ محصول'),
                        dir: "rtl",
                        templateSelection: formatRepoSelection1
                    });

                    $(".select-item-item").select2({
                        ajax: {
                            dir: "rtl",
                            language: "fa",
                            url: '/json-data-fill_data_product_item',
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
                        dropdownParent: $("#modal_form"),
                        theme: "bootstrap",
                        placeholder: ('انتخاب آیتم محصول'),
                        dir: "rtl",
                    });

                    $(".select-product-property").select2({
                        dir: "rtl",
                        language: "fa",
                        ajax: {
                            url: '/json-data-fill_data_product_property',
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
                        placeholder: ('انتخاب مشخصه ظاهری محصول'),
                        templateResult: formatRepo,
                        templateSelection: formatRepoSelection
                    });

                    function formatRepo(repo) {

                        if (repo.loading) {
                            return repo.text;
                        }

                        var $container = $(
                            "<div class='select2-result-repository clearfix'>" +
                            "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__title'></div>" +
                            "<div class='select2-result-repository__description'></div>" +
                            "<div class='select2-result-repository__color'></div>" +
                            "<div class='select2-result-repository__statistics'>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        );

                        $container.find(".select2-result-repository__statistics").text("{{__('Property')}}" + " : " + repo.text + " " + repo.hppi_items_name);

                        return $container;
                    }

                    function formatRepoSelection(repo) {
                        return repo.text || repo.id;
                    }

                    function formatRepoSelection1(repo) {
                        return repo.text || repo.id;
                    }


                    $("#sub_form1").on('click', function (event) {
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
                            url: '/product',
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            async: false,
                            success: function (data) {
                                setTimeout($.unblockUI, 2000);
                                window.location.href = "/product";
                            },
                            cache: false,
                        });
                    });

                    $("#submit_modal_color").on('click', function (event) {
                        var data =
                            {
                                hn_color_name: $("#orangeForm-name").val()
                            }
                        event.preventDefault();

                        $("#submit_modal_color").block({
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
                            url: '/product-color',
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            async: false,
                            success: function (data) {
                                setTimeout($.unblock, 2000);
                                $("#modalRegisterForm").find("input").val("");
                                $("#modalRegisterForm").modal('hide');
                                $("#hp_product_color_id").append('<option selected value="' + data.id + '">' + data.name + '</option>');

                            },
                            cache: false,
                        });
                    });

                    $("#modal_form").submit(function (event) {
                        var data = $("#modal_form").serialize();
                        event.preventDefault();
                        $("#modal_form").block({
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
                            url: '/product-property',
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            async: false,
                            success: function (data) {
                                setTimeout($.unblock);
                                $("#modalRegisterForm1").find("input").val("");
                                $("#modalRegisterForm1").modal('hide');
                                $("#hp_product_property").append('<option selected  value="' + data.id + '">' + data.name + data.item + '</option>');

                            },
                            cache: false,
                        });
                    });
                });

                Dropzone.options.dropzone =
                    {
                        maxFilesize: 12,
                        // فایل نوع آبجکت است
                        renameFile: function (file) {
                            var dt = new Date();
                            var time = dt.getTime();
                            return time + '-' + file.name;
                        },
                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                        addRemoveLinks: true,
                        timeout: 5000,
                        success: function (file, response) {
                            // اسم اینپوت و مقداری که باید به آن ارسال شود
                            $('#product_image').val(file.upload.filename);
                        },
                        error: function (file, response) {
                            return false;
                        }
                    };
            </script>
    @endpush

