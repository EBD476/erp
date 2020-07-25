@extends('layouts.app')

@section('title', __('Edit User'))

@push('css')
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class='col-lg-12'>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="col-lg-12 ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Edit')}} {{$users->name}}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('users.update',[$users->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{$users->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Username')}}</label>
                                                <input type="text" class="form-control" name="username"
                                                       value="{{$users->username}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group   ">
                                                <label>{{__('Position')}}</label>
                                                <select name="position" class="form-control">
                                                    <option value="{{$selected_position->id}}">{{$selected_position->hpu_name}}</option>
                                                    @foreach($position as $positions)
                                                        <option value="{{$positions->id}}">
                                                            {{$positions->hpu_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Current Password')}}</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('New Password')}}</label>
                                                <input type="password" class="form-control" name="newPassword">
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        @foreach ($roles as $role)
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="col-md-3">
                                                        <label>{{ucfirst($role->name)}}</label>
                                                        <input type="checkbox" name="roles[]" value="{{$role->id}}">
                                                        {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                                                        {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <input type="hidden" name="image" id="image">
                                    <input type="hidden" id="id" value="{{$users->id}}">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-block btn-primary"
                                                   value="{{__('Send')}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-description">
                                <h4 class="card-title" style="padding-right: 130px">{{__('Add Avatar')}}</h4>
                                <div class="card-body col-md-12">
                                    <form action="{{url('/user-image-save')}}" class="dropzone" id="dropzone"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <input type="file" class="form-control"
                                                   name="file" multiple>
                                        </div>
                                        @if(auth()->user()->image != '')
                                            <div class="dz-image">
                                                <img src="{{asset('img/avatar/'.auth()->user()->image)}}" id="hp_image">
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
    @role('finance|dealership|repository|product|geust|order|task')
    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class='col-lg-8'>
                <div class="card">
                    <div class="card-body">
                        <h3><i class='fa fa-user-plus pull-right'> {{__('Edit')}} {{$users->name}}</i></h3>
                        <hr>
                        <form action="{{ route('users.update',[$users->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="name" value="{{$users->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('Username')}}</label>
                                        <input type="text" class="form-control" name="username"
                                               value="{{$users->username}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('Current Password')}}</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('New Password')}}</label>
                                        <input type="password" class="form-control" name="newPassword">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="image" id="image">
                            <input type="hidden" id="id" value="{{$users->id}}">
                            <div class="row">
                                <input type="submit" class="btn btn-block btn-primary col-md-2" value="{{__('Send')}}">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-description">
                        <h4 class="card-title" style="padding-right: 130px">{{__('Add Avatar')}}</h4>
                        <div class="card-body col-md-12">
                            <form action="{{url('/user-image-save')}}" class="dropzone" id="dropzone"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <input type="file" class="form-control"
                                           name="file" multiple>
                                </div>
                                @if(auth()->user()->image != '')
                                    <div class="dz-image">
                                        <img src="{{asset('img/avatar/'.auth()->user()->image)}}" id="hp_image">
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.dz-message').text("برای انتخاب تصویر مورد نظر اینجا کلیک کنید");
        });
        // save image
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                // فایل نوع آبجکت است
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + '-' + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 5000,
                success: function (file, response) {
                    // اسم اینپوت و مقداری که باید به آن ارسال شود
                    $('#image').val(file.upload.filename);
                },
                error: function (file, response) {
                    return false;
                }
            };
        // end saving

        // remove image
        $("#hp_image").on('click', function () {

            // unlink image
            var data = {id: $('#id').val()};

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/user-destroy-image/' + data.id,
                type: 'delete',
                data: data,
                dataType: 'json',
                async: false,
                success: function (data) {
                },
                cache: false,
            });
            $("#hp_image").remove();

        });
        //end removing
    </script>
@endpush