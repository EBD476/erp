@extends('layouts.app')

@section('title',__('Project'))

@push('css')
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    @role('Admin|order')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Project')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('projects.update',$project->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-5 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Name')}}</label>
                                            <input name="project_name" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$project->hp_project_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-md-1">
                                        <div class="form-group">
                                            <label>{{__('Client Name')}}</label>
                                            <input name="project_owner" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$client->hc_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-md-1">
                                        <div class="form-group">
                                            <label>{{__('Client Phone')}}</label>
                                            <input name="owner_phone" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$project->hp_project_owner_phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Type')}}</label>
                                            <select name="project_type" class="form-control ltr">
                                                <option>{{$project->hp_project_type}}</option>
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
                                            <select class="form-control" name="hp_owner">
                                                <option>{{$project->hp_owner}}</option>
                                                <option>{{__('Residential')}}</option>
                                                <option>{{__('Office')}}</option>
                                                <option>{{__('Commercial')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-md-1">
                                        <div class="form-group">
                                            <label>{{__('Project Units')}}</label>
                                            <input name="project_units" type="number" class="form-control" required=""
                                                   aria-invalid="false" value="{{$project->hp_project_units}}">
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-4 pl-md-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>{{__('Unit Area')}}</label>--}}
                                            {{--<input name="unit_area" type="numbertext" class="form-control" required=""--}}
                                                   {{--aria-invalid="false" value="{{$project->hp_project_area}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4 pl-md-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>{{__('State')}}</label>--}}
                                            {{--<select name="project_state" class="form-control">--}}
                                                {{--@foreach($projects_state as $project_state)--}}
                                                    {{--<option value="{{$project_state->id}}">--}}
                                                        {{--{{$project_state->hp_project_state}}--}}
                                                    {{--</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>{{__('City')}}</label>--}}
                                            {{--<input name="project_city" type="text" class="form-control" required=""--}}
                                                   {{--aria-invalid="false" value="{{$project->hp_project_city}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Project Address')}}</label>
                                            <input name="project_address" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$project->hp_project_address}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Project Location')}}</label>

                                            <div id="map" style="width: 100%; height: 300px;direction: ltr"></div>
                                            <input name="project_location" type="hidden" id="location" value="{{$project->hp_project_location}}">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Project Description')}}</label>
                                            <textarea name="project_description" rows="4" cols="80"
                                                      class="form-control">{{$project->hp_project_description}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary">{{__('Submit')}}</button>
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
                                    <h5 class="title">Hanta IBMS</h5>
                                </a>
                            </div>
                            <div class="card-description">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        @endsection

        @push('scripts')
            <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
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

                L.marker([{{$project->hp_project_location}}], {icon: greenIcon}).addTo(map)
                    .bindPopup('{{$project->hp_project_address}}')
                    .openPopup();

                function onMapClick(e) {
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
    @endpush