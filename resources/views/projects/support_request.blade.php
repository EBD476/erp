@extends('layouts.app')

@section('title',__('Support Request'))

@push('css')
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush



@section('content')
    {{--    @can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{--<div class="col-md-12">--}}
                {{--@include('layouts.partial.Msg')--}}
                {{--</div>--}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Support Request')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Request Title')}}</label>
                                            <input name="hp_project_name" rows="4" cols="80"
                                                   class="form-control" id="title"
                                                   value="{{$request_support->hs_title}}"
                                                   >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Project Name')}}</label>
                                            <input name="hp_project_name" rows="4" cols="80"
                                                   class="form-control" id="hp_project_id" data-id="{{$request_support->id}}" disabled
                                                   value="{{$request_support->hp_project_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Project Description')}}</label>
                                            <textarea name="hs_description" rows="4" cols="80"
                                                      class="form-control" id="hs_description"></textarea>
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
                                Project Implementors
                            </p>
                        </div>
                        </p>
                        <div class="card-description">

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
                                <i class="fab fa-google-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="card">--}}
            {{--<div class="card-header card-header-primary">--}}
            {{--<h4 class="card-title ">{{__('Add New Project')}}</h4>--}}
            {{--<p class="card-category"></p>--}}
            {{--</div>--}}
            {{--<div class="card-body">--}}
            {{--<form method="post" action="{{route('projects.store')}}" enctype="multipart/form-data">--}}
            {{--@csrf--}}
            {{--<div class="row">--}}
            {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
            {{--<label class="bmd-label-floating">{{__('Name')}}</label>--}}
            {{--<input type="text" class="form-control" name="Name">--}}
            {{--</div>--}}

            {{--</div>--}}
            {{--</div>--}}
            {{--<a href="{{route('projects.index')}}" class="btn badge-danger">{{__('Back')}}</a>--}}

            {{--<button type="submit" class="btn badge-primary">{{__('Send')}}</button>--}}
            {{--</form>--}}
            {{--</div>--}}

            {{--</div>--}}

        </div>
    </div>
    {{--@endcan--}}
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script>
        kamaDatepicker('test-date-id', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
    </script>
    <script type="text/javascript">

        var loc;
        var greenIcon = L.icon({
            iconUrl: '../../assets/images/marker-icon-x48.png',
            shadowUrl: 'leaf-shadow.png',

            iconSize: [48, 48], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [25, 44], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        var map = L.map('map').setView([35.7736, 51.4631], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // L.marker([35.7736, 51.4631], {icon: greenIcon}).addTo(map)
        //     .bindPopup('test.')
        //     .openPopup();

        function onMapClick(e) {
            ;

            var jsonLoc = JSON.parse(JSON.stringify(e.latlng));
            $("#location").val(jsonLoc.lat + ',' + jsonLoc.lng);

            if (loc != undefined) {
                loc.remove();
            }
            loc = L.marker([jsonLoc.lat, jsonLoc.lng], {icon: greenIcon}).addTo(map);
        }

        $("#remove").click(function () {
            loc.remove();
        });

        map.on('click', onMapClick);

    </script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#form1").submit(function (event) {
                var data =
                    {
                        id: $("#hp_project_id").data('id'),
                        description :  $("#hs_description").val(),
                        title: $("#title").val(),
                    }
            event.preventDefault();
            $.blockUI();
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
                url: '/support_request',
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
        })
        ;
    </script>
@endpush