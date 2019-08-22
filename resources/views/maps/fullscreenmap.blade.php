@extends('layouts.app')

@push('css')
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
                <div id="map" class="map" style="width: 100%; height: 100%;direction: ltr"></div>
@endsection

 @push('scripts')

{{--    <script type="text/javascript" src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>

    <script>
        $(document).ready(function(){

            var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

            /**** Scroller ****/

            // if ($.fn.niceScroll){
            //     var mainScroller = $("html").niceScroll({
            //         zindex:999999,
            //         boxzoom:true,
            //         cursoropacitymin :0.5,
            //         cursoropacitymax :0.8,
            //         cursorwidth :"10px",
            //         cursorborder :"0px solid",
            //         autohidemode:false
            //     });
            // };

            /*** PerfectScrollbar ****/

            if (isWindows) {

                if ($('.main-panel').length != 0) {
                    var ps = new PerfectScrollbar('.main-panel', {
                        wheelSpeed: 2,
                        wheelPropagation: true,
                        minScrollbarLength: 20,
                        suppressScrollX: true
                    });
                }

                if ($('.sidebar .sidebar-wrapper').length != 0) {

                    var ps1 = new PerfectScrollbar('.sidebar .sidebar-wrapper');
                    $('.table-responsive').each(function () {
                        var ps2 = new PerfectScrollbar($(this)[0]);
                    });
                }

                $('html').addClass('perfect-scrollbar-on');
            }

            var greenIcon = L.icon({
                iconUrl: '../../assets/images/marker-icon.png',
                iconSize:     [24, 24], // size of the icon
            });

            var cities = L.layerGroup();

            @foreach($projects as $key => $project)
               L.marker([{{$project->hp_project_location}}], {icon: greenIcon}).bindPopup('HANTA Smart Home Project').addTo(cities);
            @endforeach

            var mbAttr = '',
                mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

            var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
                streets  = L.tileLayer(mbUrl, {id: 'mapbox.streets',   attribution: mbAttr});

            var map = L.map('map', {
                center: [32.760,53.503],
                zoom: 5,
                layers: [cities,grayscale]
            });

            var baseLayers = {
                "Grayscale": grayscale,
                "Streets": streets
            };

            var overlays = {
                "Cities": cities
            };

            sidebar_mini_active = true;

            $('body').addClass('sidebar-mini');
            $(".navbar").removeClass('bg-gradient-light');
            $(".navbar").addClass('bg-transparent');
            // map.on('click', onMapClick);

        });
    </script>
  @endpush