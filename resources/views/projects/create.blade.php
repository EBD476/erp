@extends('layouts.app')

@section('title',__('Project'))

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
                            <h4 class="card-title ">{{__('New Project')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Name')}}</label>
                                            <input name="project_name" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-md-1">
                                        <div class="form-group">
                                            <label>{{__('Owner Name')}}</label>
                                            <input name="project_owner" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-md-1">
                                        <div class="form-group">
                                            <label>{{__('Owner Phone')}}</label>
                                            <input name="owner_phone" type="number" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Type')}}</label>
                                            <select name="project_type" class="form-control ltr">
                                                    @foreach($projects_type as $project_type)
                                                        <option value="{{$project_type->id}}">{{$project_type->hp_name}}</option>
                                                    @endforeach
                                            </select>
                                            {{--<input  name="project_type"type="text" class="form-control" placeholder="{{__('Project Type')}}" >--}}
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Land Use')}}</label>
                                            <select class="form-control">
                                                <option value="1">{{__('Residential')}}</option>
                                                <option value="2">{{__('Office')}}</option>
                                                <option value="3">{{__('Commercial')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Units')}}</label>
                                            <input name="project_units" type="number" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 pl-md-1">
                                        <div class="form-group">
                                            <label>{{__('Unit Area')}}</label>
                                            <input name="unit_area" type="numbertext" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('State')}}</label>
                                            <select name="project_state" class="form-control">
                                                <option value="استان">{{__('State')}}</option>
                                                @foreach($projects as $project)
                                                    <option value="{{$project->id}}">
                                                        {{$project->hp_project_state}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('City')}}</label>
                                            <input name="project_city" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Project Address')}}</label>
                                            <input name="project_address" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Project Location')}}</label>

                                            <div id="map" style="width: 100%; height: 300px;direction: ltr"></div>
                                            <input name="project_location" type="hidden" id="location">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{--<div class="col-md-4 pr-md-1">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label>{{__('Project Options')}}</label>--}}
                                    {{--<input name="project_options" type="text" class="form-control" placeholder="{{__('Project Options')}}">--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-4 px-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Completed Percent')}}</label>
                                            <input name="project_completed" type="number" class="form-control"
                                                   required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Final Date')}}</label>
                                            <input name="project_complete_date" type="text" class="form-control"
                                                   required=""
                                                   aria-invalid="false" id="test-date-id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Project Description')}}</label>
                                            <textarea name="project_description" rows="4" cols="80"
                                                      class="form-control"></textarea>
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
                var data = $("#form1").serialize();
                event.preventDefault();
                $.blockUI();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/projects',
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