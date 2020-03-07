@extends('layouts.app')

@section('title',__('Projects Management'))

@push('script')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
@endpush


@push('css')
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">--}}
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('projects.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i>
                        {{__('New Project')}}
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
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
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-link dropdown-toggle btn-icon"
                                                            data-toggle="dropdown">
                                                        <i class="tim-icons icon-settings-gear-63"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item"
                                                           href="{{route('projects.send_request',$project->id)}}"
                                                        >{{__('Send Request')}}</a>
                                                        <a class="dropdown-item"
                                                           href="{{route('projects.edit',$project->id)}}"
                                                        >{{__('Edit')}}</a>
                                                        <form id="-form-delete{{$project->id}}"
                                                              style="display: none;" method="POST"
                                                              action="{{route('projects.destroy',$project->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a class="dropdown-item"
                                                           onclick="if(confirm('آیا از حذف این پروژه اطمینان دارید؟')){
                                                                   event.preventDefault();
                                                                   document.getElementById('-form-delete{{$project->id}}').submit();
                                                                   }else {
                                                                   event.preventDefault();}">{{__('Delete')}}</a>
                                                    </div>
                                                </div>
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
            </div>
        </div>
        {{--@endcan--}}
        @endsection

        @push('scripts')
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
            <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
            <script>
                $(document).ready(function () {

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                    $('#table').on('click', 'button', function (event) {

                        var data = table.row($(this).parents('tr')).data();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        swal({
                            // title: "",
                            text: "{{__('Are you sure?')}}",
                            buttons: ["{{__('cancel')}}", "{{__('Done')}}"],
                            icon: "warning",
                            // buttons: true,
                            dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $.ajax({
                                        url: '/projects-destroy/' + data[0],
                                        type: 'delete',
                                        data: data,
                                        dataType: 'json',
                                        async: false,
                                        success: function (data) {
                                            swal("{{__("Poof! Your imaginary file has been deleted!")}}", {
                                                icon: "success",
                                                button: "{{__('Done')}}",
                                            });
                                        },
                                        cache: false,
                                    });
                                    location.reload();
                                } else {
                                    swal(
                                        "{{__("Your imaginary file is safe!")}}",
                                        {button: "{{__('Done')}}"}
                                    );

                                }
                            });
                    });
                    var table = $('#table').on('draw.dt', function (e, settings, json, xhr) {
                        }).DataTable({

                            "processing":
                                true,
                            "serverSide":
                                true,
                            "ajax":
                                '/json-data-projects',
                            "columnDefs":
                                [{
                                    "targets": -1,
                                    "data": null,
                                    "defaultContent": "  <div class=\"dropdown\">\n" +
                                        "                                                            <a class=\"btn btn-link dropdown-toggle btn-icon\"\n" +
                                        "                                                                    data-toggle=\"dropdown\">\n" +
                                        "                                                                <i class=\"tim-icons icon-settings-gear-63\"></i>\n" +
                                        "                                                            </a>\n" +
                                        "                                                            <div class=\"dropdown-menu dropdown-menu-right\"\n" +
                                        "                                                                 aria-labelledby=\"dropdownMenuLink\">\n" +
                                        "                                                                <a href=\"{{route('order.edit',113)}}\" class=\"dropdown-item\"\n" +
                                        "                                                                >{{__('Edit')}}</a>\n" +
                                        "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +
                                        "                                                            </div>\n" +
                                        "                                                        </div>"
                                }, {
                                    "targets": -2,
                                    "data": null,
                                    "defaultContent": '  <div class="progress">\n' +
                                        '                                                            @foreach($order as $orders)\n' +
                                        '                                                            @foreach($progress as $progresses)\n' +
                                        // '                                                                <span class="progress-value">25%</span>\n' +
                                        '                                                                @if($progresses->ho_process_id == 1 and $orders->id == $progresses->order_id )\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width: 25%;"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                                @if($progresses->ho_process_id == 2 and $orders->id == $progresses->order_id)\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width: 50%;"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                                @if($progresses->ho_process_id == 3 and $orders->id == $progresses->order_id)\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width: 75%;"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                                @if($progresses->ho_process_id == 4 and $orders->id == $progresses->order_id )\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width:100%; direction: ltr"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                            @endforeach\n' +
                                        '                                                            @endforeach\n' +
                                        '                                                        </div>'
                                }],
                            "language":
                                {
                                    "sEmptyTable":
                                        "هیچ داده ای در جدول وجود ندارد",
                                    "sInfo":
                                        "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                                    "sInfoEmpty":
                                        "نمایش 0 تا 0 از 0 رکورد",
                                    "sInfoFiltered":
                                        "(فیلتر شده از _MAX_ رکورد)",
                                    "sInfoPostFix":
                                        "",
                                    "sInfoThousands":
                                        ",",
                                    "sLengthMenu":
                                        "نمایش _MENU_ رکورد",
                                    "sLoadingRecords":
                                        "در حال بارگزاری...",
                                    "sProcessing":
                                        "در حال پردازش...",
                                    "sSearch":
                                        "جستجو:",
                                    "sZeroRecords":
                                        "رکوردی با این مشخصات پیدا نشد",
                                    "oPaginate":
                                        {
                                            "sFirst":
                                                "ابتدا",
                                            "sLast":
                                                "انتها",
                                            "sNext":
                                                "بعدی",
                                            "sPrevious":
                                                "قبلی"
                                        }
                                    ,
                                    "oAria":
                                        {
                                            "sSortAscending":
                                                ": فعال سازی نمایش به صورت صعودی",
                                            "sSortDescending":
                                                ": فعال سازی نمایش به صورت نزولی"
                                        }
                                }
                        })
                    ;
                });
            </script>
            <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
            <script>
                $(document).ready(function () {
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