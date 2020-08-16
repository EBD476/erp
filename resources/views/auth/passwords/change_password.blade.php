@extends('layouts.app2')

@section('content')
    <div class="container col-md-8 h-100">

        <div class="row justify-content-center align-items-lg-center h-100 ">
            <div class="col-md-7">
                <div class="card card-white card-login">

                    <div class="card-header bg-gradient-primary pt-3 pb-5">
                        <h3 class="text-white mb-0" style="text-align: center"> {{ __('New Password') }} </h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('users.new-password') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control"
                                           name="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
