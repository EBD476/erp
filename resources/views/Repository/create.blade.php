@extends('layouts.app')

@section('title',__('Repository'))

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Add New Repository')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form id="form1" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Id')}}</label>
                                        <input type="text" class="form-control" name="Product_Id">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Stock')}}</label>
                                        <input type="text" class="form-control" name="Product_Stock">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Comment')}}</label>
                                        <textarea class="form-control" name="Comment"></textarea>
                                    </div>
                                </div>
                            </div>

                            <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $("#form1").submit(function (event) {
                var data = $("#form1").serialize();
                event.preventDefault();
                // $.blockUI();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/repository',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        // alert(data.response);
                        // setTimeout($.unblockUI, 2000);
                    },
                    cache: false,
                });
            });
        });
    </script>


@endpush