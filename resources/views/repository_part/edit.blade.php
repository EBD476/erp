@extends('layouts.app')

@section('title',__('Repository Part'))

@push('css')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>

@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Edit Part')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form id="form1">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="bmd-label-floating">{{__('Part Name')}}</label>
                                    <div class="form-group" id="rid" data-id="{{$repository_part->id}}">
                                        <select name="hrp_part_id" class="form-control select-part">
                                            <option value="{{$repository_part->hrp_part_id}}">{{$part_name->hp_name}}</option>
                                            @foreach($repository_all_name as $all)
                                                <option value="{{$all->id}}">{{$all->hr_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Repository Name')}}</label>
                                        <select name="hrp_repository_id" class="form-control">
                                            <option value="{{$repository_part->hrp_repository_id}}">{{$repository_name->hr_name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Count')}}</label>
                                        <input class="form-control" required=""
                                                  aria-invalid="false"
                                                  name="hrp_part_count" value="{{$repository_part->hrp_part_count}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrp_entry_date" id="test-date-id"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Exit Date')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrp_exit" id="test-date-id"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Return_value Date')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrp_return_value" id="test-date-id"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Status Return Part')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrp_return_value" id="test-date-id"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Comment')}}</label>
                                        <textarea class="form-control" required=""
                                                  aria-invalid="false" name="hrp_comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                        </form>
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
                var rid = $('#rid').data('id');
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
                    url: '/repository-part/' + rid,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    method:'put',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/repository-part";
                    },
                    cache: false,
                });
            });

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