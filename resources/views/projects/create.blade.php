@extends('layouts.app')

@section('title',__('Project'))


@push('script')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
@endpush

@push('css')
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush



@section('content')
    {{--    @can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">{{__('New Project')}}</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{route('projects.store')}}" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-5 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Project Name')}}</label>
                                                <input name="project_name" type="text" class="form-control"  placeholder="{{__('Project Name')}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-md-1">
                                            <div class="form-group">
                                                <label>{{__('Owner Name')}}</label>
                                                <input name="project_owner" type="text" class="form-control" placeholder="{{__('Owner Name')}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-md-1">
                                            <div class="form-group">
                                                <label>{{__('Owner Phone')}}</label>
                                                <input name="owner_phone" type="text" class="form-control" placeholder="{{__('Owner Phone')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Project Type')}}</label>
                                                <select  name="project_type" class="form-control ltr">
                                                    <option value="1">{{__('Smart Home')}}</option>
                                                    <option value="2">{{__('BMS')}}</option>
                                                    <option value="3">{{__('Touch Key')}}</option>
                                                    <option value="4">{{__('IPhone')}}</option>
                                                    <option value="5">{{__('Coding')}}</option>
                                                    <option value="6">{{__('Elevator')}}</option>
                                                </select>
                                                {{--<input  name="project_type"type="text" class="form-control" placeholder="{{__('Project Type')}}" >--}}
                                            </div>
                                        </div>
                                        <div class="col-md-4 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Land Use')}}</label>
                                                <select class="form-control" >
                                                    <option value="1">{{__('Residential')}}</option>
                                                    <option value="2">{{__('Office')}}</option>
                                                    <option value="3">{{__('Commercial')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-md-1">
                                            <div class="form-group">
                                                <label>{{__('Project Units')}}</label>
                                                <input name="project_units" type="text" class="form-control" placeholder="{{__('Project Units')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pl-md-1">
                                            <div class="form-group">
                                                <label>{{__('Unit Area')}}</label>
                                                <input name="unit_area" type="text" class="form-control" placeholder="{{__('Unit Area')}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{__('State')}}</label>
                                                <select  name="project_state" class="form-control" >
                                                        <option value="استان">استان</option>
                                                        <option value="آذربايجان شرقي">آذربايجان شرقي</option>
                                                        <option value="آذربايجان غربي">آذربايجان غربي</option>
                                                        <option value="اردبيل">اردبيل</option>
                                                        <option value="اصفهان">اصفهان</option>
                                                        <option value="البرز">البرز</option>
                                                        <option value="ايلام">ايلام</option>
                                                        <option value="بوشهر">بوشهر</option>
                                                        <option value="تهران">تهران</option>
                                                        <option value="چهارمحال بختياري">چهارمحال بختياري</option>
                                                        <option value="خراسان جنوبي">خراسان جنوبي</option>
                                                        <option value="خراسان رضوي">خراسان رضوي</option>
                                                        <option value="خراسان شمالي">خراسان شمالي</option>
                                                        <option value="خوزستان">خوزستان</option>
                                                        <option value="زنجان">زنجان</option>
                                                        <option value="سمنان">سمنان</option>
                                                        <option value="سيستان و بلوچستان">سيستان و بلوچستان</option>
                                                        <option value="فارس">فارس</option>
                                                        <option value="قزوين">قزوين</option>
                                                        <option value="قم">قم</option>
                                                        <option value="كردستان">كردستان</option>
                                                        <option value="كرمان">كرمان</option>
                                                        <option value="كرمانشاه">كرمانشاه</option>
                                                        <option value="كهكيلويه و بويراحمد">كهكيلويه و بويراحمد</option>
                                                        <option value="گلستان">گلستان</option>
                                                        <option value="گيلان">گيلان</option>
                                                        <option value="لرستان">لرستان</option>
                                                        <option value="مازندران">مازندران</option>
                                                        <option value="مركزي">مركزي</option>
                                                        <option value="هرمزگان">هرمزگان</option>
                                                        <option value="همدان">همدان</option>
                                                        <option value="يزد">يزد</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{__('City')}}</label>
                                                <input name="project_city" type="text" class="form-control" placeholder="{{__('City')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Project Address')}}</label>
                                                <input name="project_address" type="text" class="form-control" placeholder="{{__('Project Address')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Project Location')}}</label>

                                                <div  id="map" style="width: 100%; height: 300px;direction: ltr"></div>
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
                                                <input name="project_completed" type="number" class="form-control" placeholder="{{__('Project Completed Percent')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-md-1">
                                            <div class="form-group">
                                                <label>{{__('Project Final Date')}}</label>
                                                <input  name="project_complete_date"  type="date" class="form-control" placeholder="{{__('Project Final Date')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Project Description')}}</label>
                                                <textarea  name="project_description" rows="4" cols="80" class="form-control" placeholder="{{__('Project Description')}}" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary">Save</button>
                            </div>
                            </form>
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
    <script type="text/javascript">

        var loc ;
        var greenIcon = L.icon({
            iconUrl: '../../assets/images/marker-icon-x48.png',
            shadowUrl: 'leaf-shadow.png',

            iconSize:     [48, 48], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [25, 44], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        var map = L.map('map').setView([35.7736, 51.4631], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // L.marker([35.7736, 51.4631], {icon: greenIcon}).addTo(map)
        //     .bindPopup('test.')
        //     .openPopup();

        function onMapClick(e) {;

            var jsonLoc = JSON.parse(JSON.stringify(e.latlng));
            $("#location").val(jsonLoc.lat +','+ jsonLoc.lng);

            if (loc != undefined){
                loc.remove();
            }
            loc = L.marker([jsonLoc.lat, jsonLoc.lng], {icon: greenIcon}).addTo(map);
        }

        $("#remove").click(function(){
            loc.remove();
        });

        map.on('click', onMapClick);

    </script>
@endpush