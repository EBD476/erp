@extends('layouts.app')

@section('title', '| Edit Permission')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">

            <div class='col-lg-4 col-lg-offset-4'>

                {{-- @include ('errors.list') --}}

                <h3><i class='fa fa-key'></i> Edit {{$permission->name}}</h3>
                <br>
                <form action="{{ route('permissions.update',[$permission->id]) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group label-floating">
                        <label class="control-label">{{__('Permission Name')}}</label>
                        <input type="text" class="form-control" name="name" placeholder="Name"
                               value="{{$permission->name}}">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-block btn-primary" value="Edit">
                </form>
            </div>
        </div>
    </div>

@endsection