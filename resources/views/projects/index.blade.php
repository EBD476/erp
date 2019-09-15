@extends('layouts.app')

@section('title',__('Project Management'))

@push('script')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
@endpush


@push('css')
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">--}}
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('projects.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i>
                        {{__('New Project')}}
                    </a>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('Projects List')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Name')}}
                                    </th>
                                    {{--<th>--}}
                                    {{--{{__('Address')}}--}}
                                    {{--</th>--}}
                                    <th>
                                        {{__('Type')}}
                                    </th>
                                    <th>
                                        {{__('Units')}}
                                    </th>
                                    {{--<th>--}}
                                    {{--{{__('Complete Date')}}--}}
                                    {{--</th>--}}
                                    <th>
                                        {{__('Completed')}}
                                    </th>
                                    <th>
                                        {{__('Operation')}}
                                    </th>
                                    </thead>
                                    <tbody>

                                    @foreach($projects as $key => $project)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$project ->hp_project_name}}
                                            </td>
                                            {{--<td>--}}
                                            {{--{{$project ->hp_project_address}}--}}
                                            {{--</td>--}}
                                            <td>
                                                {{$project -> hp_project_type}}
                                            </td>
                                            <td>
                                                {{$project -> hp_project_units}}
                                            </td>
                                            {{--<td>--}}
                                            {{--{{$project -> hp_project_complete_date}}--}}
                                            {{--</td>--}}
                                            <td>
                                                {{$project -> hp_project_completed}}
                                            </td>
                                            <td>
                                                <a href="{{route('projects.edit',$project->id)}}"
                                                   class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                    <i class="tim-icons icon-pencil"></i></a>

                                                <form id="-form-delete{{$project->id}}" style="display: none;"
                                                      method="POST" action="{{route('projects.destroy',$project->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="btn btn-link btn-danger btn-icon btn-sm btn-neutral remove"
                                                   onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                           event.preventDefault();
                                                           document.getElementById('-form-delete{{$project->id}}').submit();
                                                           }else {
                                                           event.preventDefault();}"><i
                                                            class="tim-icons icon-simple-remove"></i></a>
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
                    <br><br>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right">{{__('Projects Locations')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div id="map" style="width: 100%; height: 400px;direction: ltr"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{--@endcan--}}
        @endsection

        @push('scripts')
            {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
            {{--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>--}}
            <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
            <script>
                $(document).ready(function () {

                    // $('#table').DataTable({
                    //     "language": {
                    //         "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                    //     }
                    // });

                    $('#table').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "عبارت جستجو",
                            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                        }

                    });

                    var loc;
                    var greenIcon = L.icon({
                        iconUrl: '../../assets/images/marker-icon.png',
                        shadowUrl: 'leaf-shadow.png',

                        iconSize: [24, 24], // size of the icon
                        shadowSize: [50, 64], // size of the shadow
                        iconAnchor: [25, 44], // point of the icon which will correspond to marker's location
                        shadowAnchor: [4, 62],  // the same for the shadow
                        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
                    });

                    // var baseMaps = {
                    //     "<span style='color: gray'>Grayscale</span>": grayscale,
                    // };

                    // var map = L.map('map', {
                    //     center: [35.7126, 51.4167],
                    //     zoom: 11,
                    // });
                    //
                    // // L.control.layers(baseMaps).addTo(map);
                    //
                    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    //     id: 'mapbox.light'
                    // }).addTo(map);

                    var cities = L.layerGroup();

                    @foreach($projects as $key => $project)
                    L.marker([{{$project->hp_project_location}}], {icon: greenIcon}).bindPopup('This is Littleton, CO.').addTo(cities);
                            @endforeach

                    var mbAttr = '',
                        mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

                    var grayscale = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
                        streets = L.tileLayer(mbUrl, {id: 'mapbox.streets', attribution: mbAttr});

                    var map = L.map('map', {
                        center: [35.7126, 51.4167],
                        zoom: 10,
                        layers: [cities, grayscale]
                    });

                    var baseLayers = {
                        "Grayscale": grayscale,
                        "Streets": streets
                    };

                    var overlays = {
                        "Cities": cities
                    };

                    // L.control.layers(baseLayers, overlays).addTo(map);


                    map.on('click', onMapClick);

                });


            </script>
    @endpush