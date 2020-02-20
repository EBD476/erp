@extends('layouts.app')

@section('title',__('Support'))

@push('script')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
@endpush


@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('All Support Request List')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table2" class="table" cellspacing="0" width="100%">
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Request Title')}}
                                            </th>
                                            <th>
                                                {{__('Project Name')}}
                                            </th>
                                            <th>
                                                {{__('Status')}}
                                            </th>
                                            <th>
                                                {{__('Created at')}}
                                            </th>
                                            <th>
                                                {{__('action')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($request as $key => $requests)
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    <td>
                                                        {{$requests->hs_title}}
                                                    </td>
                                                    @foreach($project as $projects_name)
                                                        @if($projects_name->id == $requests -> hs_project_id)
                                                            <td>
                                                                {{$projects_name->hp_project_name}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    @foreach($support_state as $support_states)
                                                        @if($support_states->id == $requests->hs_status)
                                                            <td>
                                                                {{$support_states->hss_name}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    <td>
                                                        {{$requests->created_at}}
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
                                                                   href="{{route('support.show_data',$requests->id)}}"
                                                                >{{__('Show')}}</a>
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
                                </div>
                                </p>
                                <div class="card-description">

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

            <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
            <script>
                $(document).ready(function () {
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

                });
            </script>
        @endpush
