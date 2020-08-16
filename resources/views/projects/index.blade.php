@extends('layouts.app')

@section('title',__('Projects Management'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    @role('Admin|product|order')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('projects.create')}}" class="btn btn-primary float-left mb-lg-2">
                        <i class="tim-icons icon-simple-add"></i>
                        {{__('New Project')}}
                    </a>
                    <a href="{{route('projects.show_all_response')}}"
                       class="btn btn-primary float-left mb-lg-2">
                        {{__('Support Response List')}}
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
                                            <th>
                                                {{__('Client Name')}}
                                            </th>
                                            <th>
                                                {{__('Due Date')}}
                                            </th>
                                            <th>
                                                {{__('Operation')}}
                                            </th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
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
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script>
        $(document).ready(function () {

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
                                url: '/projects-destroy/' + data[5],
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
                            $('#table').DataTable().ajax.reload();
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
                "initComplete": function(settings, json) {
                    $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                },
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

                        "render": function (data, type, row, meta) {
                            return "  <div class=\"dropdown\">\n" +
                                "                                                            <a class=\"btn btn-link dropdown-toggle btn-icon\"\n" +
                                "                                                                    data-toggle=\"dropdown\">\n" +
                                "                                                                <i class=\"tim-icons icon-settings-gear-63\"></i>\n" +
                                "                                                            </a>\n" +
                                "                                                            <div class=\"dropdown-menu dropdown-menu-right\"\n" +
                                "                                                                 aria-labelledby=\"dropdownMenuLink\">\n" +
                                "                                                                <a href=\"projects/" + data[5] + "/edit\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Edit')}}</a>\n" +
                                "                                                                <a href=\"send_request/" + data[5] + "\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Send Support Request')}}</a>\n" +
                                "                                                                <a href=\"verify_pre/" + data[4] + "/edit\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Preview Factor')}}</a>\n" +
                                "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                },
                {
                    "targets": 1,
                    "data": null,
                    "render": function (data, type, row, meta) {
                            return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Project Name')}} "  + data[1] + "<br><br> {{__('Client Name')}} : "  + data[2] + "<br><br> {{__('Due Date')}} : "  + data[3] +"<br><br> {{__('Address')}} :"  + data[10] +  "<br><br> {{__('Phone Number')}} : "  + data[6] + "<br><br> {{__('Type Project')}} : "  + data[7] + "<br><br> {{__('Contract Type')}} : "  + data[8] + "<br><br> {{__('Owner')}} : "  + data[9] + "\">\"" + data[1] + "</span>"
                    },
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
            });



            // project map

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