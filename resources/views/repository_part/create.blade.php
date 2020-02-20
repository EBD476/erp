@extends('layouts.app')

@section('title',__('Repository Part'))

@push('css')

@endpush

@section('content')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('New Part To Repository')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form id="form1">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Part Name')}}</label>
                                        <select class="form-control" name="hrp_part_id">
                                            @foreach($part_name as $name)
                                                <option value="{{$name->id}}">
                                                    {{$name->hp_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Repository Name')}}</label>
                                        <select class="form-control" name="hrp_repository_id">
                                            @foreach($repository_name as $name)
                                                <option value="{{$name->id}}">
                                                    {{$name->hr_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Count')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrp_part_count">
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('repository-part.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#form1").submit(function (event) {
                var data = $("#form1").serialize();
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
                    url: '/repository-part',
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