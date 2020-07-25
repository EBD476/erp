@extends('layouts.app')

@section('title', __('Add User'))

@push('css')
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="wrap main-content persian" data-scrollbar>
        <div class="content">
            <div class='col-lg-8'>
                <div class="card">
                    <div class="col-lg-12 ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Add User')}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Username')}}</label>
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Email')}}</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group   ">
                                        <label>{{__('Position')}}</label>
                                        <select name="position" class="form-control">
                                            @foreach($position as $positions)
                                                <option value="{{$positions->id}}">
                                            {{$positions->hpu_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group   ">
                                        <label>{{__('Password')}}</label>
                                        <input type="password" class="form-control" name="password">
                                        <p class="card-category" style="margin-top: -20px">{{__('Min 6 Character')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group   ">
                                        <label>{{__('Confirm Password')}}</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                        <p class="card-category" style="margin-top: -20px">{{__('Min 6 Character')}}</p>
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
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="image" id="image">
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
                            </form>
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
            </script>
    @endpush