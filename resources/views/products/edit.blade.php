@extends('layouts.app')

@section('title',__('Products'))


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
                            <h4 class="card-title ">{{__('Edit Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Name')}}</label>
                                            <input type="hidden" id="product_id" value="{{$product->id}}">
                                            <input name="product_name" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$product->hp_product_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Model')}}</label>
                                            <input name="product_model" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$product->hp_product_model}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Color')}}</label>
                                            <select class="form-control" name="hp_product_color_id">
                                                @foreach($color as $colors)
                                                    <option value="{{$colors->id}}">
                                                        {{$colors->hn_color_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Property')}}</label>
                                            <select class="form-control" name="hp_product_property">
                                                @foreach($properties as $property)
                                                    <option value="{{$property->id}}">
                                                        {{$property->hpp_property_name}}@foreach ($items as $item) @if($item->id == $property->hpp_property_items) {{$item->hppi_items_name}} @endif @endforeach
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Size')}}</label>
                                            <input name="hp_product_size" class="form-control" required=""
                                                   aria-invalid="false" value="{{$product->hp_product_size}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Price')}}</label>
                                            <input name="product_price" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$product->hp_product_price}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input name="hp_description" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$product->hp_description}}">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product_image" id="product_image">
                            </form>
                        </div>
                        <div class="card-body"><label style="margin-top: -20px;">{{__('Image')}}</label>
                            <div class="card-body col-md-6 pr-md-1 row"
                                 style="display: flex ; border: 1px dashed; margin-right: -35px;}">
                                <form action="{{url('/product-image-save')}}" class="dropzone"
                                      id="dropzone"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input type="file" class="form-control"
                                               name="file">
                                    </div>
                                    <div class="dz-preview dz-processing dz-image-preview dz-complete">
                                        <div class="dz-image" id="img-remove" style="margin-right: 20px">
                                            <img src={{asset('img/products/'.$product->hp_product_image)}}>
                                        </div>
                                    </div>
                                </form>
                            </div></div>

                        <br>
                        <br>
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
                            <p class="description">
                                Product
                            </p>
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
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/dropzone.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#sub_form1").on('click', function (event) {
                var data = $("#form1").serialize();
                var product_id = $('#product_id').val();
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
                    url: '/product/' + product_id,
                    type: 'POST',
                    method: 'put',
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
        $("#img-remove").on('click', function () {
            $("#img-remove").remove();
        });
    </script>
@endpush