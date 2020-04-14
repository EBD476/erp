@extends('layouts.app')

@section('title',__('Products Middle Parts'))

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
                            <h4 class="card-title ">{{__('Edit Product Middle Parts')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <label>{{__('Product Name')}}</label>
                                        <div class="form-group">
                                            <select class="form-control select-product" name="hpp_product_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <label>{{__('Middle Part Name')}}</label>
                                        <div class="form-group">
                                            <select class="form-control select-middle-part"
                                                    name="hpp_middle_part_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Part Count')}}</label>
                                            <input name="hpp_part_count" type="text" class="form-control" required=""
                                                   id="part_id" data-id="{{$product_part->id}}"
                                                   aria-invalid="false" value="{{$product_part->hpp_part_count}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary">{{__('Save')}}</button>
                                </div>
                            </form>
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
        @endrole
        @endsection

        @push('scripts')
            <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
            <script>
                $(document).ready(function () {
                    $("#form1").submit(function (event) {
                        var data = $("#form1").serialize();
                        var pid = $('#part_id').data('id');
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
                            url: '/product-middle-part/' + pid,
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            async: false,
                            method:'put',
                            success: function (data) {
                                setTimeout($.unblockUI, 2000);
                                window.location.href = "/product-middle-part";

                            },
                            cache: false,
                        });
                    });

                    // fill data in select product
                    $(".select-product").select2({
                        ajax: {
                            url: '/json-data-fill_data_product',
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
                        placeholder:('انتخاب محصول'),
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

                    // fill data in select middle part
                    $(".select-middle-part").select2({
                        dir: "rtl",
                        language: "fa",
                        ajax: {
                            url: '/json-data-fill_data_middle_part',
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
                });
            </script>
    @endpush